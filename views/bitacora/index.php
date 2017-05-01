<?php
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BitacoraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bitacoras');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bitacora-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Bitacora'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php

    $gridColumns = [
        'idBitacora',
        'fechaHora',
        'actividad',
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

            'idBitacora',
            'fechaHora',
            'actividad',
            'id_Empresa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
