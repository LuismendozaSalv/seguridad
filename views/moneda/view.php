<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Moneda */

$this->title = $model->tipoMoneda;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Monedas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moneda-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modificar'), ['update', 'id' => $model->codMoneda], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->codMoneda], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codMoneda',
            'tipoMoneda',
            'simbolo',
           // 'id_Empresa',
        ],
    ]) ?>

</div>
