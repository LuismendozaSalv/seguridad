<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respaldo */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Respaldo',
]) . $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Respaldos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigoRespaldo, 'url' => ['view', 'id' => $model->codigoRespaldo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="respaldo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
