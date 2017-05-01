<?php

use app\models\Usuario;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Moneda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="moneda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipoMoneda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'simbolo')->textInput(['maxlength' => true]) ?>

    <?php $idemp=0;
    $iduser = Yii::$app->user->getId();
    $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
    foreach ($emp as $emp2) {
        $idemp=$emp2->id_Empresa ;
    }
    ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
