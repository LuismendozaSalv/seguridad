<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetalleAsiento */

$this->title = Yii::t('app', 'Create Detalle Asiento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalle Asientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-asiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
