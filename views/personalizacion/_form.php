<?php

use app\models\Usuario;
use bizley\quill\Quill;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
use dosamigos\tinymce\TinyMce;

    /* @var $this yii\web\View */
/* @var $model app\models\Personalizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personalizacion-form">

    <?php $form = ActiveForm::begin(); ?>

   <?="Selecionar color de fondo de pagina"?>
    <?= $form->field($model, 'Color', [
        'template' => "{input}"
    ])->input('color',['class'=>"input_class"]) ?>

    <?= $form->field($model, 'Fuente')->dropDownList(
        ['Arial'=>'Arial','Times New Roman'=>'Times New Roman','Arial Black'=>'Arial Black','Impact'=>'Impact'],           // Flat array ('id'=>'label')
        ['prompt'=>'Seleccione tipo de letra']    // options
    ); ?>
    <?= $form->field($model, 'tamano')->dropDownList(
        ['small'=>'pequeño','medium'=>'mediana','x-medium'=>'normal','large'=>'grande'],           // Flat array ('id'=>'label')
        ['prompt'=>'Seleccione el tamaño de la letra']    // options
    ); ?>
   <?php $iduser = Yii::$app->user->getId();
        $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
           foreach ($emp as $emp2) {
               $idemp=$emp2->id_Empresa ;
               $idemp = filter_var(strip_tags(isset($idemp),FILTER_SANITIZE_NUMBER_INT));
            }
    ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>
    <?=$form->field($model, 'id_Usuario')->hiddenInput(['value'=> $iduser])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Guardar/Restaurar') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
