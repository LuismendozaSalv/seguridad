<?php

use app\models\Usuario;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nivel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nivel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?php $idemp=0;

        $iduser = Yii::$app->user->getId();
        $iduser = filter_var(strip_tags($iduser,FILTER_SANITIZE_NUMBER_INT));
        $emp= Usuario::find()->where(['idUsuario'=>$iduser])->all();
        foreach ($emp as $emp2) {
           $idemp=$emp2->id_Empresa ;
            $idemp = filter_var(strip_tags($idemp,FILTER_SANITIZE_NUMBER_INT));
        }
    ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>
    <input type="text" name="trampita" style="display: none"/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
