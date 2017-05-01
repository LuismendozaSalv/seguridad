<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LibroDiario */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Libro Diario',
]) . $model->idDiario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libro Diarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idDiario, 'url' => ['view', 'id' => $model->idDiario]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="libro-diario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
