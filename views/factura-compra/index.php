<?php
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FacturaCompraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Factura Compras');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-compra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
       <!-- <?= Html::a(Yii::t('app', 'Nueva Factura-Compra'), ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>
    <?php

    $gridColumns = [
        'codigoResp',
        'tipo',
        'nit',
        'razonSocial',
        'nroFactura',
         'poliza',
         'nroAutorizacion',
         'fecha',
         'subtotal',
         'ICE',
         'descuento',
         'total',
         'IVA',
         'codigoControl',

    ];
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);
    ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigoResp',
            'tipo',
            'nit',
            'razonSocial',
            'nroFactura',
            // 'poliza',
            // 'nroAutorizacion',
            // 'fecha',
            // 'subtotal',
            // 'ICE',
            // 'descuento',
            // 'total',
            // 'IVA',
            // 'codigoControl',
            // 'id_Empresa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
