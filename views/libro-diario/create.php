<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LibroDiario */

$this->title = Yii::t('app', 'Generar Libro Diario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Libro Diarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libro-diario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
