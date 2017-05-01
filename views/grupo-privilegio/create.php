<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GrupoPrivilegio */

$this->title = Yii::t('app', 'Agregar Grupo Privilegio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupo Privilegios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-privilegio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
