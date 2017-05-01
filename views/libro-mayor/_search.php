<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LibroMayorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="libro-mayor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idMayor') ?>

    <?= $form->field($model, 'codCuenta') ?>

    <?= $form->field($model, 'fechaIni') ?>

    <?= $form->field($model, 'fechaFin') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
