<?php

namespace app\controllers;

use app\models\GrupoPrivilegio;
use Yii;
use app\models\Grupousuario;
use app\models\GrupoUsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuario;
/**
 * GrupoUsuarioController implements the CRUD actions for GrupoUsuario model.
 */
class GrupoUsuarioController extends Controller
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

    /**
     * Lists all GrupoUsuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $searchModel = new GrupoUsuarioSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
            return $this->redirect(["site/denied"]);
        }
    }

    /**
     * Displays a single GrupoUsuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->redirect(["site/denied"]);
    }

    /**
     * Creates a new GrupoUsuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function obtenerOn($array){
        
    }
    public function actionCreate()
    {


        $otra = $this->obtenerOtra();

        if($otra>0) {
            $model = new Grupousuario();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $i=0;
                $array=Yii::$app->request->bodyParams;

                while($i <count($array['priv'])){
                    $privileg = new grupoPrivilegio();
                    $priv= $array['priv'][$i];
                    $grupo = $model -> idGrupo;
                    $idEmp = $model -> id_Empresa;
                    $data= [];
                    $data['id_Privilegio']=$priv;
                    $data['id_Grupo']=$grupo;
                    $data['id_Empresa']=$idEmp;

                    $privileg->setAttributes($data);
                    $privileg->save();
                    $i++;
                }
                return $this->redirect(["grupo-usuario/index"]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        else{
            return $this->redirect(["site/denied"]);
        }

    }

    public function obtenerOtra(){
        $idGrupo=0;
        $iduser = Yii::$app->user->getId();
        $User=Usuario::find()->where(['idUsuario'=>$iduser])->one();
        $idGrupo = $User->id_Grupo;


        $sql = "select count(*)
                        from grupoprivilegio
                        where id_Privilegio = 11 and id_Grupo =  $idGrupo ";

        $otra =  Yii::$app->db->createCommand($sql)->queryScalar();
        return $otra;
    }

    /**
     * Updates an existing GrupoUsuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->redirect(["site/denied"]);
    }

    /**
     * Deletes an existing GrupoUsuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return $this->redirect(["site/denied"]);
    }

    /**
     * Finds the GrupoUsuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GrupoUsuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Grupousuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
