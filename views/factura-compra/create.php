<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FacturaCompra */

$this->title = Yii::t('app', 'Create Factura Compra');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Factura Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-compra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
