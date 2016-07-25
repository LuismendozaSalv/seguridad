<?php

use app\models\Usuario;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respaldo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respaldo-form">



    <?php $idAsiento=null;
    if (!empty($_GET['idAsiento'])) {
        $idAsiento = $_GET['idAsiento'];
    } ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?=$form->field($model, 'id_Asiento')->hiddenInput(['value'=> $idAsiento])->label(false); ?>

    <?php
    $iduser = Yii::$app->user->getId();
    $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
    foreach ($emp as $emp2) {
        $idemp=$emp2->id_Empresa ;
    }
    ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>


    
    <?= $form->field($model, 'tipoResp')->dropDownList(
        ['1'=>'cheque','2'=>'factura Compra','3'=>'facturaVenta'],           // Flat array ('id'=>'label')
        ['prompt'=>'Seleccione tipo de Respaldo']    // options
    ); ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
