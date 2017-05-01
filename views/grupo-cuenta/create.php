<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GrupoCuenta */

$this->title = Yii::t('app', 'Agregar Grupo Cuenta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupo Cuentas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-cuenta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
