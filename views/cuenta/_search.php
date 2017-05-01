<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuenta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigoCuenta') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'codPadre') ?>

    <?= $form->field($model, 'id_Empresa') ?>

    <?= $form->field($model, 'id_Nivel') ?>

    <?php // echo $form->field($model, 'cod_Grupo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
