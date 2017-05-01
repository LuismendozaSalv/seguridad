<?php
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FacturaVentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Factura Ventas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-venta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
      <!--  <?= Html::a(Yii::t('app', 'Create Factura Venta'), ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>
    <?php

    $gridColumns = [
        'codigoResp',
        'nit',
        'razonSocial',
        'nroFactura',
        'nroAutorizacion',
        'fecha',
         'subtotal',
        'ICE',
        'descuento',
        'total',
        'IVA',
        'validado',
        'codigoControl',
        'id_Empresa',

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
            'nit',
            'razonSocial',
            'nroFactura',
            'nroAutorizacion',
            // 'fecha',
            // 'subtotal',
            // 'ICE',
            // 'descuento',
            // 'total',
            // 'IVA',
            // 'validado',
            // 'codigoControl',
            // 'id_Empresa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
