<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoPrivilegio */

$this->title = Yii::t('app', 'Modificar {modelClass}: ', [
    'modelClass' => 'Grupo Privilegio',
]) . $model->id_Privilegio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupo Privilegios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_Privilegio, 'url' => ['view', 'id_Privilegio' => $model->id_Privilegio, 'id_Grupo' => $model->id_Grupo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="grupo-privilegio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
