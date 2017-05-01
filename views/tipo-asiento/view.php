<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAsiento */

$this->title = $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Asientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-asiento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->idTipo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->idTipo], [
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
            'idTipo',
            'descripcion',
           // 'id_Empresa',
        ],
    ]) ?>

</div>
