<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cuenta */

$this->title = $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuenta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->codigoCuenta], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->codigoCuenta], [
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
            'codigoCuenta',
            'descripcion',
            'codPadre',
            'id_Empresa',
            'id_Nivel',
            'cod_Grupo',
        ],
    ]) ?>

</div>
