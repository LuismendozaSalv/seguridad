<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Permiso denegado';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about" xmlns="http://www.w3.org/1999/html">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
    <p>
        No tiene Permiso para acceder a esta pagina </br>
        Posible intruso :P
    </p>
    </div>
    <a href="<?= Url::toRoute("site/index") ?>">Ir a inicio</a>


</div>
