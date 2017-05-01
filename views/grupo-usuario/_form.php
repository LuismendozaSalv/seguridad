<?php

use app\models\Usuario;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Empresa;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\GrupoUsuario */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="grupo-usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?php $idemp=0;
        $iduser = Yii::$app->user->getId();    
        $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
        foreach ($emp as $emp2) {
            $idemp=$emp2->id_Empresa ;
        }      
    ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>
    
<div style="border: 2px solid #1a1a1a; background: #adadad">
    <h1> Asignar Privilegios </h1>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="6"><h5>Gestionar Empresa</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="18"><h5>Gestionar Usuario</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="2"><h5>Consultar bitacora</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="15"><h5>Asignar privilegio</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="11"><h5>Administrar Grupo Usuario</h5></label>

</div>
<div style="border: 2px solid #1a1a1a; background: #adadad">


    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="4"><h5>Gestionar Cuenta</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="13"><h5>Gestionar Nivel</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="3"><h5>Gestionar Cheque</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="8"><h5>Gestionar Factura Venta</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="7"><h5>Gestionar Factura Compra</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="9"><h5>Administrar Grupo Cuenta</h5></label>
</div>
<div style="border: 2px solid #1a1a1a; background: #adadad">

    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="1"><h5>Gestionar Asiento</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="16"><h5>Gestionar Respaldo</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="12"><h5>Gestionar Moneda</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="17"><h5>Gestionar Tipo Asiento</h5></label>
</div>
<div style="border: 2px solid #1a1a1a; background: #adadad">

    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="19"><h5>Gestionar Libro diario</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="20"<h5>Gestionar Libro Mayor</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="21"><h5>Gestionar Sumas y Saldos</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="22"><h5>Gestionar Balance General</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="23"><h5>Gestionar Estado de resultados</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="24"><h5>Gestionar Libro Compras</h5></label>
    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="25"><h5>Gestionar Libro Ventas</h5></label>
</div>
<div style="border: 2px solid #1a1a1a; background: #adadad">

    <label class="checkbox-inline"><input type="checkbox" name="priv[]" value="14"><h5>Gestionar Personalizacion</h5></label>

</div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</body>
