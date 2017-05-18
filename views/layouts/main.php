<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Personalizacion;
use app\models\Usuario;
use yii\bootstrap\Dropdown;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

 <?php    if (Yii::$app->user->id!=null) :?>
    <style>
        body{
        <?php    $iduser = Yii::$app->user->getId();
        $user=Usuario::find()->where(['idUsuario'=>$iduser])->one();
            $emp=Personalizacion::find()->where(['id_Usuario'=>$iduser])->all();
            $color="default" ;
            $fuente="default";
            $size="default";

        foreach ($emp as $emp2) {
            $color=$emp2->Color ;
            $fuente=$emp2->Fuente;
            $size=$emp2->tamano;
        }?>
            font-family: <?= $fuente?>;
            font-size:<?= $size?> ;
            background-color: <?= $color?>;
        }
    </style>

    <?php endif; ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php 
    if (Yii::$app->user->isGuest) :

    NavBar::begin([
        'brandLabel' => 'Conta Servi',
        'brandUrl' => Yii::$app->homeUrl,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([

        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Login', 'url' => ['/site/login']],
        ],
    ]);
        NavBar::end();
    endif;
    ?>

    <?php
    if (!Yii::$app->user->isGuest) :
        $iduser = Yii::$app->user->getId();
        $user= Usuario::find()->where(['idUsuario'=>$iduser])->one();
        NavBar::begin([

            'brandLabel' => '<span class="glyphicon glyphicon-globe"></span>'.' Conta Servi',
            'brandUrl' => Yii::$app->homeUrl,

            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'encodeLabels'=>false,
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => [
                
                [
                    'label' => 'Cuentas',
                    'items' => [
                        ['label' =>'<span class="glyphicon glyphicon-sort-by-order"></span>'.Html::encode('  Gestion de Cuentas') , 'url' => ['/cuenta/index']],
                        ['label' =>  '<span class="glyphicon glyphicon-sort-by-order"></span>'.Html::encode('   Niveles'), 'url' => ['/nivel/index']],
                        ['label' =>  '<span class="glyphicon glyphicon-sort-by-order"></span>'.Html::encode('  Grupo de cuenta'), 'url' => ['/grupo-cuenta']],

                        '<li class="divider"></li>',
                        '<li class="dropdown-header">'.Html::encode('     Opciones de Cuenta').'</li>'.
                        '<li class="divider"></li>',
                        ['label' => '<span class="glyphicon glyphicon-usd"></span>'.Html::encode('   Moneda'), 'url' => ['/moneda/index']],
                    ],
                ],



            ],
        ]);
        echo Nav::widget([
            'encodeLabels'=>false,
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                [
                    'label' => Html::encode('Gestión de Usuarios ').'<span class="glyphicon glyphicon-user"></span>',
                    'items' => [
                        ['label' => '<span class="glyphicon glyphicon-tower"></span>'.' Usuario', 'url' => ['/usuario/index']],
                        '<li class="divider"></li>',
                        '<li class="dropdown-header">Opciones de Usuarios</li>',
                        ['label' => 'Grupos de Usuario', 'url' => ['/grupo-usuario/index']],
                        /*['label' => 'Grupos de Privilegio', 'url' => ['/grupo-privilegio/index']],*/

                    ],
                ],
                [
                    'label' => '<span class="glyphicon glyphicon-cog"></span>',
                    'items' => [
                        ['label' => '<span class="glyphicon glyphicon-floppy-save"></span>'.Html::encode(' Copias de Seguridad y Respaldo'), 'url' => ['/backuprestore'],],
                        ['label' => '<span class="glyphicon glyphicon-menu-hamburger"></span>'.Html::encode(' Personalizar'), 'url' => ['/personalizacion/create'],],
                        ['label' => '<span class="glyphicon glyphicon-comment"></span>'.Html::encode(' Soporte Tecnico'), 'url' => ['site/contact'],],

                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                        . Html::submitButton(
                            '<span class="glyphicon glyphicon-user"></span>'.' Salir ('.$user->nombre.') ',
                            ['class' => 'btn btn-default']
                        )

                        . Html::endForm()
                        . '</li>',

                    ],
                ]
            ],
        ]);

        NavBar::end();
    endif;
    ?>



    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
