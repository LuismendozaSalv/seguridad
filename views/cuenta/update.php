<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cuenta */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Cuenta',
]) . $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigoCuenta, 'url' => ['view', 'id' => $model->codigoCuenta]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar Cuenta');
?>
<div class="cuenta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
