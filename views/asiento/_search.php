<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AsientoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asiento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idAsiento') ?>

    <?= $form->field($model, 'glosa') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'id_Usuario') ?>

    <?= $form->field($model, 'cod_Moneda') ?>

    <?php // echo $form->field($model, 'id_TipoA') ?>

    <?php // echo $form->field($model, 'id_Empresa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
