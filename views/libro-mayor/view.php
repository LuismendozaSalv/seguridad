<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LibroMayor */

$this->title = $model->idMayor;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libro Mayors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libro-mayor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idMayor], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idMayor], [
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
            'idMayor',
            'codCuenta',
            'fechaIni',
            'fechaFin',
        ],
    ]) ?>

</div>
