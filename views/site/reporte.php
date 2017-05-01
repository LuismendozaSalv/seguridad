<?php

/* @var $this yii\web\View */

use app\models\Usuario;

$this->title = 'Reportes';
?>

<div class="site-repotes">

    <div class="jumbotron">
        <h1>Bienvenido a Reportes</h1>

        <p class="lead">Seleccione su reporte requerido!</p>
        <?php if (Yii::$app->user->isGuest) : ?>

            <?php else : ?>
            
            <a class="btn btn-lg btn-default" href="../libro-diario/create"> <span class="glyphicon glyphicon-tasks"></span> Libro Diario</a><br>
            <a class="btn btn-lg btn-warning" href="../libro-mayor/create"><span class="glyphicon glyphicon-tasks"></span> Libro Mayor</a><br>
            <a class="btn btn-lg btn-success" href="../balance-general/create"><span class="glyphicon glyphicon-tasks"></span> Balance General</a><br>
            <a class="btn btn-lg btn-primary" href="../estado-resultado/create"><span class="glyphicon glyphicon-tasks"></span> Estado de Resultados</a><?php endif; ?><br>
            <a class="btn btn-lg btn-danger" href="../balance-sumas-saldos/create"><span class="glyphicon glyphicon-tasks"></span> Balance de Comprobacion de Sumas y Saldos</a><br>

    </div>

    <div class="body-content">

        <div class="row">


        </div>

    </div>
</div>

