<?php

namespace app\controllers;

use app\models\GrupoPrivilegio;
use app\models\Grupousuario;
use Yii;
use app\models\Empresa;
use app\models\EmpresaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuario;
/**
 * EmpresaController implements the CRUD actions for Empresa model.
 */
class EmpresaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function obtenerOtra(){
        $idGrupo=0;
        $iduser = Yii::$app->user->getId();
        $User=Usuario::find()->where(['idUsuario'=>$iduser])->one();
        $idGrupo = $User->id_Grupo;


        $sql = "select count(*)
                        from grupoprivilegio
                        where id_Privilegio = 6 and id_Grupo =  $idGrupo ";

        $otra =  Yii::$app->db->createCommand($sql)->queryScalar();
        return $otra;
    }

    /**
     * Lists all Empresa models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (Yii::$app->user->isGuest){
            return $this->redirect(["site/denied"]);
        }
    }

    /**
     * Displays a single Empresa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            return $this->redirect(["site/denied"]);
        }
    }

    /**
     * Creates a new Empresa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empresa();
        $array=Yii::$app->request->bodyParams;
        if (!empty($array)){
            if ($array['trampita'] != ""){
                return $this->render('create', [
                    'model' => $model,
                ]);

            }
        }

        if ($model->load(Yii::$app->request->post())) {
                $nit = trim($model->nit);
                $model->nit = strip_tags($nit);
                $razonSocial = trim($model->razonSocial);
                $model->razonSocial = strip_tags($razonSocial);
                $direccion = trim($model->direccion);
                $model->direccion = strip_tags($direccion);
                $ciudad = trim($model->ciudad);
                $model->ciudad = strip_tags($ciudad);
                $pais = trim($model->pais);
                $model->pais = strip_tags($pais);
                $telefono = trim($model->telefono);
                $model->telefono = strip_tags($telefono);
                $model->save();
                $default = new Grupousuario();
                $default->id_Empresa = $model->idEmpresa;
                $default->descripcion = "Contador";
                $default->save();
                $i=1;

                while($i < 26){
                    $privileg = new grupoPrivilegio();
                    $priv= $i;
                    $grupo = $default -> idGrupo;
                    $idEmp = $model -> idEmpresa;
                    $data= [];
                    $data['id_Privilegio']=$priv;
                    $data['id_Grupo']=$grupo;
                    $data['id_Empresa']=$idEmp;

                    $privileg->setAttributes($data);
                    $privileg->save();
                    $i++;
                }

                $encriptado = $this->encriptar($model->idEmpresa);

                return $this->redirect(['usuario/create', 'id' => $encriptado]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

    }

    public function encriptar($codigo){
        $id = $codigo * 0X621333;
        return $id;
    }

    /**
     * Updates an existing Empresa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(($id % 0X621333) != 0 || is_string($id)){
            return $this->redirect(["site/denied"]);
        }
        if (Yii::$app->user->isGuest){
            return $this->redirect(["site/denied"]);
        }
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idEmpresa]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else{
            return $this->redirect(["site/denied"]);
        }
    }

    /**
     * Deletes an existing Empresa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect(["site/denied"]);
        }
    }

    /**
     * Finds the Empresa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empresa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empresa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
