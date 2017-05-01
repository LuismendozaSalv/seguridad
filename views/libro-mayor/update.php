<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LibroMayor */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Libro Mayor',
]) . $model->idMayor;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libro Mayors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMayor, 'url' => ['view', 'id' => $model->idMayor]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="libro-mayor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
