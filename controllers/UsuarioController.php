<?php

namespace app\controllers;

use app\models\Grupousuario;
use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
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
                        where id_Privilegio = 18 and id_Grupo =  $idGrupo ";

        $otra =  Yii::$app->db->createCommand($sql)->queryScalar();
        return $otra;
    }
    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect(["site/denied"]);
        }
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $searchModel = new UsuarioSearch();
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
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect(["site/denied"]);
        }
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
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
            if (!isset($_GET['is'])){
                return $this->redirect(["site/denied"]);
            }
            $model = new Usuario();
            $array=Yii::$app->request->bodyParams;
            if (!empty($array)){
                if ($array['trampita'] != ""){
                    return $this->render('create', [
                        'model' => $model,
                    ]);

                }
            }
            if ($model->load(Yii::$app->request->post())) {
                if (($model->id_Empresa % 0X621333) != 0){
                    return $this->redirect(["site/denied"]);
                }
                $passwd = trim($model->passwd);
                $model->passwd = strip_tags($passwd);
                $id_Empresa = trim($model->id_Empresa);
                $model->id_Empresa = strip_tags($id_Empresa);
                $direccion = trim($model->direccion);
                $model->direccion = strip_tags($direccion);
                $telefono = trim($model->telefono);
                $model->telefono = strip_tags($telefono);
                $id_Grupo = trim($model->id_Grupo);
                $model->id_Grupo = strip_tags($id_Grupo);
                $idEmpresa = $this->desencriptar($model->id_Empresa);
                $model->id_Empresa = $idEmpresa;
                $grupo = Grupousuario::find()->where(['id_Empresa' => $idEmpresa])->all();
                $model->id_Grupo = $grupo[0]->idGrupo;
                $model->save();
                return $this->redirect(['site/login']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
    }

    public function desencriptar($cript){
        return $cript / 0X621333;
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect(["site/denied"]);
        }
        if(($id % 0X621333) != 0 || is_string($id)){
            return $this->redirect(["site/denied"]);
        }
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idUsuario]);
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
     * Deletes an existing Usuario model.
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
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
