<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChequeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cheque-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigoResp') ?>

    <?= $form->field($model, 'nroCuenta') ?>

    <?= $form->field($model, 'nombreReceptor') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'id_Empresa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
