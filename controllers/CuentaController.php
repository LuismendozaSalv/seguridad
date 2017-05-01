<?php

namespace app\controllers;

use app\models\Bitacora;
use Yii;
use app\models\Cuenta;
use app\models\CuentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuario;
/**
 * CuentaController implements the CRUD actions for Cuenta model.
 */
class CuentaController extends Controller
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
                        where id_Privilegio = 4 and id_Grupo =  $idGrupo ";

        $otra =  Yii::$app->db->createCommand($sql)->queryScalar();
        return $otra;
    }

    /**
     * Lists all Cuenta models.
     * @return mixed
     */
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
    
    public function actionIndex()
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $searchModel = new CuentaSearch();
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
     * Displays a single Cuenta model.
     * @param string $id
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
     * Creates a new Cuenta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $otra = $this->obtenerOtra();
        
        if($otra>0) {
            
            $model = new Cuenta();
            $model->load(Yii::$app->request->post());
            $array=Yii::$app->request->bodyParams;
            if (!empty($array)){
                if ($array['trampita'] != ""){
                    return $this->render('create', [
                        'model' => $model,
                    ]);

                }
            }

            $cod=$model->codigoCuenta;
            $desc = $model->descripcion;
            $nivel=$model->id_Nivel;
            $codPadre = $model->codPadre;

            if ($codPadre == "-"){
                $codPadre = null;

            }

            $codG = $model->cod_Grupo;
            $emp = $model->id_Empresa;
            $data['codigoCuenta']=$cod;
            $data['descripcion']=$desc;
            $data['codPadre']=$codPadre;
            $data['id_Empresa']=$emp;
            $data['id_Nivel']=$nivel;
            $data['cod_Grupo']=$codG;

            $cuenta = new Cuenta();
            $cuenta->setAttributes($data);

            if ( $cuenta->save()) {
                $this->bitacorear("Creación de Cuenta");
                return $this->redirect(['view', 'id' => $model->codigoCuenta]);
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
    public function actionLists($id)
    {
        
        $countAccount = \app\models\Cuenta::find()
            ->where(['id_nivel' => $id-1])
            ->count();

        $models = \app\models\Cuenta::find()
            ->where(['id_nivel' => $id-1])
            ->all();

        if ($countAccount > 0) {
            foreach ($models as $model) {

                echo "<option value='" . $model->codigoCuenta . "'>" . $model->descripcion. "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }

    /**
     * Updates an existing Cuenta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $otra = $this->obtenerOtra();
        if($otra>0) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->codigoCuenta]);
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
     * Deletes an existing Cuenta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cuenta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Cuenta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cuenta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
