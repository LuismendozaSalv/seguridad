<?php

namespace app\controllers;

use Yii;
use app\models\DetalleAsiento;
use app\models\DetalleAsientoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuario;

/**
 * DetalleAsientoController implements the CRUD actions for DetalleAsiento model.
 */
class DetalleAsientoController extends Controller
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
                        where id_Privilegio = 5 and id_Grupo =  $idGrupo ";

        $otra =  Yii::$app->db->createCommand($sql)->queryScalar();
        return $otra;
    }
    /**
     * Lists all DetalleAsiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $searchModel = new DetalleAsientoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('lista'); /*[
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);*/
        }
        else{
            return $this->redirect(["site/denied"]);
        }
    }

    /**
     * Displays a single DetalleAsiento model.
     * @param integer $id_Asiento
     * @param string $codigo_Cuenta
     * @return mixed
     */
    public function actionView($id_Asiento, $codigo_Cuenta)
    {

        $otra = $this->obtenerOtra();
        if($otra>0) {
            return $this->render('view', [
                'model' => $this->findModel($id_Asiento, $codigo_Cuenta),
            ]);
        }
        else{
            return $this->redirect(["site/denied"]);
        }
    }

    /**
     * Creates a new DetalleAsiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        $otra = $this->obtenerOtra();
        if($otra>0) {
            $model = new DetalleAsiento();
            $model->load(Yii::$app->request->post());
            
            if ($model->load(Yii::$app->request->post())) {
                return $this->render('lista');
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

    /**
     * Updates an existing DetalleAsiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_Asiento
     * @param string $codigo_Cuenta
     * @return mixed
     */
    public function actionUpdate($id_Asiento, $codigo_Cuenta)
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $model = $this->findModel($id_Asiento, $codigo_Cuenta);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_Asiento' => $model->id_Asiento, 'codigo_Cuenta' => $model->codigo_Cuenta]);
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
     * Deletes an existing DetalleAsiento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_Asiento
     * @param string $codigo_Cuenta
     * @return mixed
     */
    public function actionDelete($id_Asiento, $codigo_Cuenta)
    {
        $this->findModel($id_Asiento, $codigo_Cuenta)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DetalleAsiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_Asiento
     * @param string $codigo_Cuenta
     * @return DetalleAsiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_Asiento, $codigo_Cuenta)
    {
        if (($model = DetalleAsiento::findOne(['id_Asiento' => $id_Asiento, 'codigo_Cuenta' => $codigo_Cuenta])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
