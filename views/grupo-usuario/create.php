<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GrupoUsuario */

$this->title = Yii::t('app', 'Crear Grupo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupo Usuario'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
