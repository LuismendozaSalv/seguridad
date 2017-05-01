<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LibroDiario */

$this->title = $model->idDiario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libro Diarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libro-diario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idDiario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idDiario], [
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
            'idDiario',
            'fechaIni',
            'fechaFin',
        ],
    ]) ?>

</div>
