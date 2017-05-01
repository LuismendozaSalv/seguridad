<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FacturaCompra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-compra-form">
    <?php $form = ActiveForm::begin(); ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Agregar y quitar celdas</title>
        <script>

            function myCreateFunction() {

                var tabla = document.getElementById("myTable");

                var fila = tabla.insertRow();

                var celda1 = fila.insertCell(0);
                var celda2 = fila.insertCell(1);
                var celda3 = fila.insertCell(2);
                var celda4 = fila.insertCell(3);
                var celda5 = fila.insertCell(4);
                var celda6 = fila.insertCell(5);
                var celda7 = fila.insertCell(6);
                var celda8 = fila.insertCell(7);
                var celda9 = fila.insertCell(8);
                var celda10 = fila.insertCell(9);
                var celda11 = fila.insertCell(10);
                var celda12 = fila.insertCell(11);

                var campo1 = document.createElement("input");
                campo1.type = "text";
                campo1.setAttribute("onclick","vaciar_campo(this);");

                var campo2 = campo1.cloneNode(true);
                var campo3 = campo1.cloneNode(true);
                var campo4 = campo1.cloneNode(true);
                var campo5 = campo1.cloneNode(true);
                var campo6 = campo1.cloneNode(true);
                var campo7 = campo1.cloneNode(true);
                var campo8 = campo1.cloneNode(true);
                var campo9 = campo1.cloneNode(true);
                var campo10 = campo1.cloneNode(true);
                var campo11 = campo1.cloneNode(true);
                var campo12 = campo1.cloneNode(true);

                celda1.appendChild(campo1);
                celda2.appendChild(campo2);
                celda3.appendChild(campo3);
                celda4.appendChild(campo4);
                celda5.appendChild(campo5);
                celda6.appendChild(campo6);
                celda7.appendChild(campo7);
                celda8.appendChild(campo8);
                celda9.appendChild(campo9);
                celda10.appendChild(campo10);
                celda11.appendChild(campo11);
                celda12.appendChild(campo12);


            }

            function vaciar_campo(input) {

                input.value = "";

            }
        </script>
    </head>

    <body>
    <table id="myTable" class="table-bordered">
        <thead class="thead-inverse">
            <tr style="background: #0ac962" >
                <td class="active">Tipo</td>
                <td class="success">NIT</td>
                <td class="warning">Razon Social</td>
                <td class="danger">Nro Factura</td>
                <td class="danger">Poliza</td>
                <td class="danger">Numero de Autorizacion</td>
                <td class="danger">Subtotal</td>
                <td class="danger">ICE</td>
                <td class="danger">Descuento</td>
                <td class="danger">Total</td>
                <td class="danger">IVA</td>
                <td class="danger">Codigo de control</td>
            </tr>
        </thead>
    </table>


    <button onclick="myCreateFunction()"  type="button" class="btn btn-success">Agregar Fila</button>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
