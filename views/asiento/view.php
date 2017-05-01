<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Asiento */

$this->title = $model->idAsiento;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asiento-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idAsiento',
            'glosa',
            'fecha',
            'id_Usuario',
            'cod_Moneda',
            //'id_TipoA',
            'id_Empresa',
        ],
    ]) ?>

</div>
