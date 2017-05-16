<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;


/* @var $this yii\web\View */
/* @var $model app\models\Empresa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nit',['inputOptions' => [
        'autocomplete' => 'off']])->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'razonSocial',['inputOptions' => [
        'autocomplete' => 'off']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion',['inputOptions' => ['autocomplete' => 'off']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ciudad',['inputOptions' => ['autocomplete' => 'off']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pais',['inputOptions' => ['autocomplete' => 'off']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono',['inputOptions' => ['autocomplete' => 'off']])->textInput(['maxlength' => 11]) ?>

    <input type="text" name="trampita" style="display: none"/>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Registrar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
