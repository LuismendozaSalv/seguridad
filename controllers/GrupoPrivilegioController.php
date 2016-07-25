<?php

namespace app\controllers;

use Yii;
use app\models\GrupoPrivilegio;
use app\models\GrupoPrivilegioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuario;
/**
 * GrupoPrivilegioController implements the CRUD actions for GrupoPrivilegio model.
 */
class GrupoPrivilegioController extends Controller
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
                        where id_Privilegio = 10 and id_Grupo =  $idGrupo ";

        $otra =  Yii::$app->db->createCommand($sql)->queryScalar();
        return $otra;
    }
    /**
     * Lists all GrupoPrivilegio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $searchModel = new GrupoPrivilegioSearch();
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
     * Displays a single GrupoPrivilegio model.
     * @param integer $id_Privilegio
     * @param integer $id_Grupo
     * @return mixed
     */
    public function actionView($id_Privilegio, $id_Grupo)
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            return $this->render('view', [
                'model' => $this->findModel($id_Privilegio, $id_Grupo),
            ]);
        }
        else{
            return $this->redirect(["site/denied"]);
        }
    }

    /**
     * Creates a new GrupoPrivilegio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $model = new GrupoPrivilegio();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_Privilegio' => $model->id_Privilegio, 'id_Grupo' => $model->id_Grupo]);
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
     * Updates an existing GrupoPrivilegio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_Privilegio
     * @param integer $id_Grupo
     * @return mixed
     */
    public function actionUpdate($id_Privilegio, $id_Grupo)
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $model = $this->findModel($id_Privilegio, $id_Grupo);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_Privilegio' => $model->id_Privilegio, 'id_Grupo' => $model->id_Grupo]);
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
     * Deletes an existing GrupoPrivilegio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_Privilegio
     * @param integer $id_Grupo
     * @return mixed
     */
    public function actionDelete($id_Privilegio, $id_Grupo)
    {
        $this->findModel($id_Privilegio, $id_Grupo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GrupoPrivilegio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_Privilegio
     * @param integer $id_Grupo
     * @return GrupoPrivilegio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_Privilegio, $id_Grupo)
    {
        if (($model = GrupoPrivilegio::findOne(['id_Privilegio' => $id_Privilegio, 'id_Grupo' => $id_Grupo])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
