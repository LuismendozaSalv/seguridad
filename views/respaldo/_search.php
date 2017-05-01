<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RespaldoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respaldo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'codigoRespaldo') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'id_Asiento') ?>

    <?= $form->field($model, 'id_Empresa') ?>

    <?= $form->field($model, 'tipoResp') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
