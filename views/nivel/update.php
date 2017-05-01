<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nivel */

$this->title = Yii::t('app', 'Actualizar Nivel: ', [
    'modelClass' => 'Nivel',
]) . $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nivels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idNivel, 'url' => ['view', 'id' => $model->idNivel]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="nivel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
