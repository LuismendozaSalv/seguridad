<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BalanceGeneral */

$this->title = Yii::t('app', 'Create Balance General');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Balance Generals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-general-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
