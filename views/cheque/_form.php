<?php

use app\models\Usuario;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Cheque */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $codResp = null;
    if (!empty($_GET)) {
        $codResp = filter_var(strip_tags(isset($_GET['id']) ? $_GET['id']: 0 ),FILTER_SANITIZE_NUMBER_INT);
    }
    ?>

    <?=$form->field($model, 'codigoResp')->hiddenInput(['value'=> $codResp])->label(false); ?>

    <?= $form->field($model, 'nroCuenta')->textInput() ?>

    <?= $form->field($model, 'nombreReceptor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monto')->textInput() ?>

    <?= $form->field($model, 'fecha')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy/mm/dd',
            
        ]
    ]); ?>

    <?php
    $iduser = Yii::$app->user->getId();
    $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
    foreach ($emp as $emp2) {
        $idemp=$emp2->id_Empresa ;
    }
    ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>
    <input type="text" name="trampita" style="display: none"/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
