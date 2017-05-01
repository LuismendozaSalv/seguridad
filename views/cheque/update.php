<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cheque */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Cheque',
]) . $model->codigoResp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cheques'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigoResp, 'url' => ['view', 'id' => $model->codigoResp]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cheque-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
