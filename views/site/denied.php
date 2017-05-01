<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Permiso denegado';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
    <p>
        No tiene Permiso para acceder a esta pagina
    </p>
    </div>
    <a href="<?= Url::toRoute("site/index") ?>">Ir a inicio</a>

    <code><?= __FILE__ ?></code>
</div>
