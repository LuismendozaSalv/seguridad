<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Moneda */

$this->title = Yii::t('app', 'Modificar Moneda', [
    'modelClass' => 'Moneda',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Monedas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codMoneda, 'url' => ['view', 'id' => $model->codMoneda]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar Moneda');
?>
<div class="moneda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
