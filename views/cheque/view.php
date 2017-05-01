<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cheque */

$this->title = "Nro Cheque: ".$model-> codigoResp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cheques'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cheque-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->codigoResp], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->codigoResp], [
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
            'codigoResp',
            'nroCuenta',
            'nombreReceptor',
            'monto',
            'fecha',
          //  'id_Empresa',
        ],
    ]) ?>

</div>
