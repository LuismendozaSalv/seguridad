<?php

use app\models\Tipoasiento;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAsiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-asiento-form">
    <?php $idemp=0;
    $iduser = Yii::$app->user->getId();
    $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
    foreach ($emp as $emp2) {
        $idemp=$emp2->id_Empresa ;
    }
    $idTipo=0;
    $tipo = Tipoasiento::find()->all();
    foreach ($tipo as $emp2) {
        $idTipo=$emp2->idTipo;
    }

    ?>
    <?php $form = ActiveForm::begin(); ?>

    
    <?=$form->field($model, 'idTipo')->hiddenInput(['value'=> $idTipo+1])->label(false); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>




    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
