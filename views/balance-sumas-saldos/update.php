<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BalanceSumasSaldos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Balance Sumas Saldos',
]) . $model->idBalance;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Balance Sumas Saldos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idBalance, 'url' => ['view', 'id' => $model->idBalance]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="balance-sumas-saldos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
