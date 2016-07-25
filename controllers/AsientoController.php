<?php

namespace app\controllers;

use app\models\Bitacora;
use app\models\Detalleasiento;
use app\models\Grupousuario;
use app\models\Usuario;
use Yii;
use app\models\Asiento;
use app\models\AsientoSearch;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AsientoController implements the CRUD actions for Asiento model.
 */
class AsientoController extends Controller
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
     * Lists all Asiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $otra = $this->obtenerOtra();
        if($otra > 0) {
            $searchModel = new AsientoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(["site/denied"]);
        }
    }

    /**
     * Displays a single Asiento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function obtenerOtra(){
       $idGrupo=0;
        $iduser = Yii::$app->user->getId();
        $User=Usuario::find()->where(['idUsuario'=>$iduser])->one();
        $idGrupo = $User->id_Grupo;
        
        
        $sql = "select count(*)
                        from grupoprivilegio
                        where id_Privilegio = 1 and id_Grupo =  $idGrupo ";
        
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
public function actionCreate()
    {
        $this->bitacorear("guardar asiento");
        $otra = $this->obtenerOtra();
        if($otra > 0){
                $model = new Asiento();
                if ($model->load(Yii::$app->request->post())) {
                        $debeVerif = 0;
                        $haberVerif = 0;
                        $array=Yii::$app->request->bodyParams;
                        $j = 0;

                        while ($j < count($array['debe'])){
                            if($array['debe'][$j] != 0){
                                $debeVerif=+$array['debe'][$j];
                            }
                            if($array['haber'][$j] != 0) {
                                $haberVerif = +$array['haber'][$j];
                            }
                            $j++;
                        }

                    if($haberVerif == $debeVerif ){
                        $model->save();
                    $i=0;
                        while ($i < count($array['codCuenta']))
                        {

                            if ($array['codCuenta'][$i] != "")
                            {
                                $detail= new Detalleasiento();
                                $data=[];
                                $codigoCuenta= $array['codCuenta'][$i];
                                $string = preg_replace('/\s+/', '', $codigoCuenta);
                                $debe=$array['debe'][$i];
                                $haber=$array['haber'][$i];
                                $idA= $model->idAsiento;
                                $idE= $model->id_Empresa;
                                $data['id_Asiento']=$idA;
                                $data['codigo_Cuenta']=$codigoCuenta;
                                $data['debe']=$debe;
                                $data['haber']=$haber;
                                $data['id_Empresa']=$idE;


                                $detail->id_Asiento = $idA;
                                $detail->codigo_Cuenta = $string;
                                $detail->debe = $debe;
                                $detail->haber = $haber;
                                $detail->id_Empresa = $idE;

                                $detail->save();
                            }
                            $i+=1;
                        }

                    return $this->redirect(['respaldo/create', 'id' => $model->idAsiento]);
                    }
                    else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
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
     * Updates an existing Asiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            
            return $this->redirect(['view', 'id' => $model->idAsiento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Asiento model.
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
     * Finds the Asiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Asiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asiento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
