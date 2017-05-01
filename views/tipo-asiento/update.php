<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAsiento */

$this->title = Yii::t('app', 'Actualizar Tipo-Asiento: ', [
    'modelClass' => 'Tipo Asiento',
]) . $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Asientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTipo, 'url' => ['view', 'id' => $model->idTipo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-asiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
