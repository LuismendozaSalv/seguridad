<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\FacturaVenta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-venta-form">


    <?php $form = ActiveForm::begin(); ?>

    <?php $codResp = null;
    if (!empty($_GET)) {
        $codResp = $_GET['id'];
    }
    ?>

    <?=$form->field($model, 'codigoResp')->hiddenInput(['value'=> $codResp])->label(false); ?>

    <?= $form->field($model, 'codigoResp')->textInput() ?>

    <?= $form->field($model, 'nit')->textInput() ?>

    <?= $form->field($model, 'razonSocial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nroFactura')->textInput() ?>

    <?= $form->field($model, 'nroAutorizacion')->textInput() ?>

    <?= $form->field($model, 'fecha')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => true,
        // modify template for custom rendering
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy/mm/dd'
        ]
    ]); ?>

    <?= $form->field($model, 'subtotal')->textInput() ?>

    <?= $form->field($model, 'ICE')->textInput() ?>

    <?= $form->field($model, 'descuento')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'IVA')->textInput() ?>

    <?= $form->field($model, 'validado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigoControl')->textInput() ?>

    <?= $form->field($model, 'id_Empresa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
