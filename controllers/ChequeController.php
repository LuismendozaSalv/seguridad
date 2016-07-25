<?php

namespace app\controllers;

use Yii;
use app\models\Cheque;
use app\models\ChequeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuario;
/**
 * ChequeController implements the CRUD actions for Cheque model.
 */
class ChequeController extends Controller
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
                        where id_Privilegio = 3 and id_Grupo =  $idGrupo ";

        $otra =  Yii::$app->db->createCommand($sql)->queryScalar();
        return $otra;
    }
    /**
     * Lists all Cheque models.
     * @return mixed
     */
    public function actionIndex()
    {
        $otra = $this->obtenerOtra();
        if($otra>0){
            $searchModel = new ChequeSearch();
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
     * Displays a single Cheque model.
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
     * Creates a new Cheque model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $model = new Cheque();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->codigoResp]);
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
     * Updates an existing Cheque model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->codigoResp]);
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
     * Deletes an existing Cheque model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cheque model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cheque the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cheque::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
