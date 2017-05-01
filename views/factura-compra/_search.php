<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaCompraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-compra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigoResp') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'nit') ?>

    <?= $form->field($model, 'razonSocial') ?>

    <?= $form->field($model, 'nroFactura') ?>

    <?php // echo $form->field($model, 'poliza') ?>

    <?php // echo $form->field($model, 'nroAutorizacion') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'ICE') ?>

    <?php // echo $form->field($model, 'descuento') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'IVA') ?>

    <?php // echo $form->field($model, 'codigoControl') ?>

    <?php // echo $form->field($model, 'id_Empresa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
