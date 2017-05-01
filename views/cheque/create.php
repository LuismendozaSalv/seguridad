<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cheque */

$this->title = Yii::t('app', 'Crear Cheque');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cheques'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cheque-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
