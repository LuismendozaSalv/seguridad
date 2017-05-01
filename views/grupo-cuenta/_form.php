<?php

use app\models\Grupocuenta;
use app\models\Usuario;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoCuenta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-cuenta-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $idemp=0;
    $iduser = Yii::$app->user->getId();
    $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
    foreach ($emp as $emp2) {
        $idemp=$emp2->id_Empresa ;
    }
    $codCta = 0;
    $codCuenta = Grupocuenta::find()->all();
    foreach ($codCuenta as $emp2) {
        $codCta=$emp2->codGrupo ;
    }
    
    ?>

    <?=$form->field($model, 'codGrupo')->hiddenInput(['value'=> $codCta+1])->label(false); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>


    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
