<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleAsiento */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Detalle Asiento',
]) . $model->id_Asiento;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalle Asientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_Asiento, 'url' => ['view', 'id_Asiento' => $model->id_Asiento, 'codigo_Cuenta' => $model->codigo_Cuenta]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="detalle-asiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
