<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoAsiento */

$this->title = Yii::t('app', 'Agregar Tipo Asiento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Asientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-asiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
