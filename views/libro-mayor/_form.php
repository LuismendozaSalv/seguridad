<?php

use app\models\Cuenta;
use app\models\Usuario;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LibroMayor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="libro-mayor-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $idemp=0;
    $iduser = Yii::$app->user->getId();
    $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
    foreach ($emp as $emp2) {
        $idemp=$emp2->id_Empresa ;
    }

    ?>

    <?= $form->field($model, 'codCuenta')->dropDownList(ArrayHelper::map(Cuenta::find()->where(['id_Empresa' => $idemp])->all(),'codigoCuenta','descripcion'),
        [
            'prompt' => 'Seleccionar Cuenta',

        ]); ?>
    <?= $form->field($model, 'fechaIni')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy/mm/dd'
        ]
    ]);?>



    <?= $form->field($model, 'fechaFin')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy/mm/dd'
        ]
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
