<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaCompra */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Factura Compra',
]) . $model->codigoResp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Factura Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigoResp, 'url' => ['view', 'id' => $model->codigoResp]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="factura-compra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
