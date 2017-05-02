<?php

/* @var $this yii\web\View */

$this->title = 'ContaServi';
?>
<div class="site-index">
    <a href="https://seal.beyondsecurity.com/vulnerability-scanner-verification/seguridadsw2.tk"><img src="https://seal.beyondsecurity.com/verification-images/seguridadsw2.tk/vulnerability-scanner-2.gif" alt="Website Security Test" border="0" /></a>
    <div class="jumbotron">
        <h1>Bienvenido</h1>

        <p class="lead">Estamos a su servicio!</p>
        <?php if (Yii::$app->user->isGuest) : ?>
            <p>

                <a class="btn btn-lg btn-success" href="empresa/create">Comencemos</a>
            </p>
            <?php else : ?>
           <p> <img width="500px" height="250px" style="border-color: #00aa00" src="http://www.utel.edu.mx/blog/wp-content/uploads/2015/04/shutterstock_188334569.jpg"></p>
        <?php endif; ?>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Soporte Tecnico</h2>

                <p></p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Guia del Usuario &raquo;</a></p>
                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Contacto &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Facil de usar</h2>

                <p>Facilita la capacidad de registrar todas tus operaciones contables de una manera practica, olvidate
                    del papel y lapiz.</p>


            </div>
            <div class="col-lg-4">
                <h2>Desde cualquier parte del mundo</h2>

                <p>Permitira acceder a la informacion contable de tu empresa desde cualquier lugar.</p>


            </div>
        </div>

    </div>
</div>
