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
                <h2>Seguro</h2>
            </div>
            <div class="col-lg-4">
                <h2>Facil de usar</h2>

                <p>Facilita la capacidad de registrar todas tus operaciones contables de una manera practica, olvidate
                    del papel y lapiz.</p>


            </div>
            <div class="col-lg-4">
                <script language="JavaScript" type="text/javascript">
                    //<![CDATA[
                        function inhabilitar(){
                            alert ("UserSitio No Puede Usar el Click Derecho Copyright 2011.")
                            return false
                        }

                    document.oncontextmenu=inhabilitar
                    //]]>
                </script>
                <script type='text/javascript'>
                    var isCtrl = false;
                    document.onkeyup=function(e)
                    {
                        if(e.which == 17)
                            isCtrl=false;
                    }
                    document.onkeydown=function(e)
                    {
                        if(e.which == 17)
                            isCtrl=true;
                        if((e.which == 85) || (e.which == 67) && (isCtrl == true))
                        {
                            return false;
                        }
                    }
                    var isNS = (navigator.appName == "Netscape") ? 1 : 0;
                    if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
                    function mischandler(){
                        return false;
                    }
                    function mousehandler(e){
                        var myevent = (isNS) ? e : event;
                        var eventbutton = (isNS) ? myevent.which : myevent.button;
                        if((eventbutton==2)||(eventbutton==3)) return false;
                    }
                    document.oncontextmenu = mischandler;
                    document.onmousedown = mousehandler;
                    document.onmouseup = mousehandler;
                </script>
                Fin de la conversación
                Escribe un mensaje...

                Elegir archivos
                Elegir archivos

                <h2>Repositorio</h2>
                <img src="../web/image/qr_img.png">
            </div>
        </div>

    </div>
</div>
