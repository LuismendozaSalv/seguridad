<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Privilegio */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Privilegio',
]) . $model->idPrivilegio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Privilegios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPrivilegio, 'url' => ['view', 'id' => $model->idPrivilegio]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="privilegio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
