<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BitacoraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bitacora-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idBitacora') ?>

    <?= $form->field($model, 'fechaHora') ?>

    <?= $form->field($model, 'actividad') ?>

    <?= $form->field($model, 'id_Empresa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
