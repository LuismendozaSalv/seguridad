<?php

use app\models\Empresa;
use app\models\Grupousuario;
use app\models\Usuario;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\Query;
$connection = \Yii::$app->db;
/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userName')->textInput(['maxlength' => true]) ?>

    <?php 
        $idemp=0;
        $iduser = Yii::$app->user->getId();
    
        $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();

        foreach ($emp as $emp2) {
              $idemp=$emp2->id_Empresa ;
        }
        if($idemp == 0){
            $idemp = filter_var(strip_tags(isset($_GET['id']) ? $_GET['id']: 0 ),FILTER_SANITIZE_NUMBER_INT);
        }
    ?>


    <?= $form->field($model, 'passwd')->passwordInput(['maxlength' => true]) ?>
    <?php $idEmp = Yii::$app->user->getId() ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'id_Grupo')->hiddenInput(['value'=> $idEmp])->label(false); ?>

    <input type="text" name="trampita" style="display: none"/>
   <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Registrar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
