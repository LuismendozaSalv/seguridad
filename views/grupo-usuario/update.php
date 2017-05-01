<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoUsuario */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Grupo Usuario',
]) . $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupo Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idGrupo, 'url' => ['view', 'id' => $model->idGrupo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="grupo-usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
