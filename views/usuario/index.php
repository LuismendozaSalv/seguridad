<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Registrar Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
        
        $gridColumns = [
            'idUsuario',
            'nombre',
            'userName',
            'passwd',
            'id_Empresa',
            //'direccion',
            //'telefono',
            //'id_Grupo',
        ];
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);
    ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idUsuario',
            'nombre',
            'userName',
            'passwd',
           // 'id_Empresa',
            // 'direccion',
            // 'telefono',
            // 'id_Grupo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
