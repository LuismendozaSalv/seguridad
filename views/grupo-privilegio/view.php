<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoPrivilegio */

$this->title = $model->id_Privilegio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupo Privilegios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-privilegio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modificar'), ['update', 'id_Privilegio' => $model->id_Privilegio, 'id_Grupo' => $model->id_Grupo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id_Privilegio' => $model->id_Privilegio, 'id_Grupo' => $model->id_Grupo], [
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
            'id_Privilegio',
            'id_Grupo',
            'id_Empresa',
        ],
    ]) ?>

</div>
