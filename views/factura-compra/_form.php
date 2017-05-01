<?php

use app\models\Usuario;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\FacturaCompra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-compra-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $codResp = null;
    if (!empty($_GET)) {
        $codResp = filter_var(strip_tags(isset($_GET['id']) ? $_GET['id']: 0 ),FILTER_SANITIZE_NUMBER_INT);
    }
    ?>
    
    <?=$form->field($model, 'codigoResp')->hiddenInput(['value'=> $codResp])->label(false); ?>


    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'nit')->textInput() ?>

    <?= $form->field($model, 'razonSocial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nroFactura')->textInput() ?>

    <?= $form->field($model, 'poliza')->textInput() ?>

    <?= $form->field($model, 'nroAutorizacion')->textInput() ?>

    <?= $form->field($model, 'fecha')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
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

    <?= $form->field($model, 'codigoControl')->textInput(['maxlength' => true]) ?>

    <?php
        $iduser = Yii::$app->user->getId();
        $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
        foreach ($emp as $emp2) {
            $idemp=$emp2->id_Empresa ;
        }
    ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>

    <input type="text" name="trampita" style="display: none"/>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
