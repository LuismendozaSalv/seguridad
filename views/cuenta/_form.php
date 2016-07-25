<?php

use app\models\Cuenta;
use app\models\Grupocuenta;
use app\models\Nivel;
use app\models\Usuario;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cuenta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuenta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigoCuenta')->textInput(['maxlength' => true]) ?>
    <?php $idemp=0;
    $iduser = Yii::$app->user->getId();
    $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
    foreach ($emp as $emp2) {
        $idemp=$emp2->id_Empresa ;
    }
    
    ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>
    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_Nivel')->dropDownList(ArrayHelper::map(Nivel::find()->where(['id_Empresa' => $idemp])->all(),'idNivel','descripcion'),
                                                                    [
                                                                        'prompt' => 'Seleccionar Nivel',
                                                                        'class'=>'btn btn-info dropdown-toggle',
                                                                        'onchange'=>' 
                                                                        $.post("'.Yii::$app->urlManager->createUrl('cuenta/lists?id=').
                                                                            '"+$(this).val(),function( data ) 
                                                                            {
                                                                                $( "select#cuenta-codpadre" ).html( data );
                                                                            });
                                                                            '
                                                                    ]);

    ?>

    
    <?= $form->field($model, 'codPadre')->dropDownList(ArrayHelper::map(Cuenta::find()->where(['id_Empresa' => $idemp])->all(),'codigoCuenta','descripcion'),
                                                                    [
                                                                        'prompt' => 'Seleccionar CodPadre',
                                                                        'class'=>'btn btn-info dropdown-toggle'
                                                                    ]); ?>






    <?= $form->field($model, 'cod_Grupo')->dropDownList(ArrayHelper::map(Grupocuenta::find()->where(['id_Empresa' => $idemp])->all(),'codGrupo','descripcion')) ?>
    <script>

    </script>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
