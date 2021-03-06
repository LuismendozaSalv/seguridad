<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaVenta */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Factura Venta',
]) . $model->codigoResp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Factura Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigoResp, 'url' => ['view', 'id' => $model->codigoResp]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="factura-venta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
