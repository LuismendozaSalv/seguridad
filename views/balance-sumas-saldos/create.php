<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BalanceSumasSaldos */

$this->title = Yii::t('app', 'Create Balance Sumas Saldos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Balance Sumas Saldos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-sumas-saldos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
