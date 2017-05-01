<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EstadoResultado */

$this->title = $model->idEstado;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estado Resultados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-resultado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idEstado], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idEstado], [
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
            'idEstado',
            'fechaIni',
            'fechaFin',
        ],
    ]) ?>

</div>
