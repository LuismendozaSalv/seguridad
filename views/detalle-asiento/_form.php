<?php

use reportico\reportico\components\reportico;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\DetalleAsiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-asiento-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_Asiento')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
       // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ]);?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'codigo_Cuenta')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ]);?>




    <?= $form->field($model, 'debe')->textInput() ?>

    <?= $form->field($model, 'haber')->textInput() ?>

    <?= $form->field($model, 'id_Empresa')->textInput() ?>
    <html>
    <body>
</html>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'index') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
