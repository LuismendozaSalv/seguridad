<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nivel */

$this->title = Yii::t('app', 'Agregar Nivel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nivels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nivel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
