<?php

namespace app\controllers;

use app\models\Usuario;
use Yii;
use app\models\Estadoresultado;
use app\models\EstadoResultadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstadoResultadoController implements the CRUD actions for EstadoResultado model.
 */
class EstadoResultadoController extends Controller
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
                        where id_Privilegio =23 and id_Grupo =  $idGrupo ";

        $otra =  Yii::$app->db->createCommand($sql)->queryScalar();
        return $otra;
    }
    /**
     * Lists all EstadoResultado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstadoResultadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLista($fechaIni, $fechaFin, $idEmpresa)
    {
        return $this->render('lista',[ 'fechaIni' => $fechaIni, 'fechaFin'=>$fechaFin, 'idEmpresa'=>$idEmpresa]);
    }
    /**
     * Displays a single EstadoResultado model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EstadoResultado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $otra = $this->obtenerOtra();
        if($otra > 0){
        $model = new Estadoresultado();
        $idEmp=0;
        $iduser = Yii::$app->user->getId();
        $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
        foreach ($emp as $emp2) {
            $idEmp=$emp2->id_Empresa ;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([ 'lista','fechaIni' => $model->fechaIni, 'fechaFin'=>$model->fechaFin, 'idEmpresa'=>$idEmp]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        }else{
            return $this->redirect(["site/denied"]);
        }
    }
    /**
     * Updates an existing EstadoResultado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEstado]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EstadoResultado model.
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
     * Finds the EstadoResultado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EstadoResultado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estadoresultado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
