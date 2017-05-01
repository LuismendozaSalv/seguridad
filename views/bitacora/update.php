<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bitacora */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Bitacora',
]) . $model->idBitacora;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bitacoras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idBitacora, 'url' => ['view', 'id' => $model->idBitacora]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="bitacora-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
