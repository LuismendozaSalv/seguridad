<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoCuenta */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Grupo Cuenta',
]) . $model->codGrupo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupo Cuentas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codGrupo, 'url' => ['view', 'id' => $model->codGrupo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar Grupo Cuenta');
?>
<div class="grupo-cuenta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
