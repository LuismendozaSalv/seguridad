<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BalanceGeneral */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Balance General',
]) . $model->idBalance;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Balance Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idBalance, 'url' => ['view', 'id' => $model->idBalance]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="balance-general-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
