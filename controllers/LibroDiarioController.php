<?php

namespace app\controllers;

use app\models\Bitacora;
use app\models\Usuario;
use Yii;
use app\models\Librodiario;
use app\models\LibroDiarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LibroDiarioController implements the CRUD actions for LibroDiario model.
 */
class LibroDiarioController extends Controller
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
     * Lists all LibroDiario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LibroDiarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('lista', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LibroDiario model.
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
     * Creates a new LibroDiario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionLista($fechaIni,$fechaFin,$idEmpresa)
    {

        $model = new Librodiario();
        return $this->render('lista',['fechaIni' => $fechaIni, 'fechaFin'=>$fechaFin, 'idEmpresa'=>$idEmpresa]);
    }
    public function actionCreate()
    {
        $otra = $this->obtenerOtra();
        if($otra > 0) {
        $model = new Librodiario();
        $idEmp=0;
        $iduser = Yii::$app->user->getId();
        $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
        foreach ($emp as $emp2) {
            $idEmp=$emp2->id_Empresa ;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->bitacorear("Generó de Libro Diario");
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
     * Updates an existing LibroDiario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idDiario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LibroDiario model.
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
     * Finds the LibroDiario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LibroDiario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function obtenerOtra(){
        $idGrupo=0;
        $iduser = Yii::$app->user->getId();
        $User=Usuario::find()->where(['idUsuario'=>$iduser])->one();
        $idGrupo = $User->id_Grupo;


        $sql = "select count(*)
                        from grupoprivilegio
                        where id_Privilegio = 19 and id_Grupo =  $idGrupo ";

        $otra =  Yii::$app->db->createCommand($sql)->queryScalar();
        return $otra;
    }

    public function bitacorear($actividad)
    {
        $bitacora = new Bitacora();
        $iduser = Yii::$app->user->getId();
        $emp = Usuario::find()->where(['idUsuario' => $iduser])->all();
        foreach ($emp as $emp2) {
            $bitacora->userName = $emp2->userName;
            $bitacora->id_Empresa = $emp2->id_Empresa;
        }
        $bitacora->actividad = $actividad;
        $bitacora->save();
    }
    
    protected function findModel($id)
    {
        if (($model = LibroDiario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
