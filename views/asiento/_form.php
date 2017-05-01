<?php

use app\models\Moneda;
use app\models\Tipoasiento;
use app\models\Usuario;
use app\models\Cuenta;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Asiento */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="asiento-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'fecha')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'inline' => false,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy/mm/dd'
        ]
    ]); ?>
    <?= $form->field($model, 'glosa')->textInput(['maxlength' => true]) ?>
    
    <?php $idemp=0;
        $iduser = Yii::$app->user->getId();
        $iduser = filter_var(strip_tags($iduser,FILTER_SANITIZE_NUMBER_INT));
        $emp=Usuario::find()->where(['idUsuario'=>$iduser])->all();
        foreach ($emp as $emp2) {
            $idemp=$emp2->id_Empresa ;
            $idemp = filter_var(strip_tags($idemp,FILTER_SANITIZE_NUMBER_INT));
        }
    ?>
    <?= $form->field($model, 'cod_Moneda')->dropDownList(ArrayHelper::map(Moneda::find()->where(['id_Empresa' => $idemp])->all(),'codMoneda','tipoMoneda')) ?>
    <?= $form->field($model, 'id_TipoA')->dropDownList(ArrayHelper::map(Tipoasiento::find()->where(['id_Empresa' => $idemp])->all(),'idTipo','descripcion')) ?>
    <?=$form->field($model, 'id_Empresa')->hiddenInput(['value'=> $idemp])->label(false); ?>
    <?=$form->field($model, 'id_Usuario')->hiddenInput(['value'=> $iduser])->label(false); ?>
    <input type="text" name="trampita" style="display: none"/>
    
    <select id="mySelect"  style="display:none;" >
        <?php
        $tablacuenta = new Cuenta();
        $listaCuentas =$tablacuenta->find()->where(['id_Empresa'=>$idemp])->all();
        foreach ($listaCuentas as $depto ){
            ?>
            <option value = " <?php echo $depto['codigoCuenta']; ?> "><?php echo  $depto['codigoCuenta'] ."      |      ". $depto['descripcion']; ?></option>
            <?php
        }
        ?>
    </select>

    <table id="myTable" class="table-bordered = 2", style="text-align: center">
        <thead style="text-align: center">
        <tr>
            <th  width="200px",height="50px">Cuenta</th>
            <th width="200px",height="50px">Debe</th>
            <th width="200px",height="50px">Haber</th>
        </tr>
        </thead>
        <tbody>


        </tbody>
    </table>
        <script type="text/javascript">
            function createSelect()
            {
                var selectDynamic = document.getElementById('mySelect');
                var options = selectDynamic.options;

                var newSelect = document.createElement('select');
                for(var i=0; i < options.length; i++){
                    var opt = document.createElement('option');
                    opt.text = options[i].text;
                    opt.value = options[i].value;
                    newSelect.add(opt);
                }
                return newSelect;
            }
            var tam=0;
            var prueba = 0;
            function myCreateFunction() {

                var tabla = document.getElementById("myTable");

                var fila = tabla.insertRow();
                var celda1 = fila.insertCell(0);
                var celda2 = fila.insertCell(1);
                var celda3 = fila.insertCell(2);


                var campo1 = createSelect('mySelect');
                campo1.name="codCuenta[]";

                var campo3 = document.createElement("input");
                campo3.name="debe[]";
                campo3.type = "text";

                var campo4 = document.createElement("input");;
                campo4.name="haber[]";
                campo4.type = "text";

                celda1.appendChild(campo1);
                celda2.appendChild(campo3);
                celda3.appendChild(campo4);

                tam++;

            }
            function myDeleteFunction(){
                if (tam>0){
                document.getElementById("myTable").deleteRow(tam);
                tam--;
                }
            }

        </script>





    <div class="btn-group">
        <button onclick="myCreateFunction()"  type="button" class="btn btn-primary">Agregar Fila</button>
        <button onclick="myDeleteFunction()"  type="button" class="btn btn-primary">Eliminar Fila</button>

    </div>



    </div>
        <?= Html::submitButton('Guardar', [ 'class' => 'btn btn-success', 'onclick' => '(post () { alert("Button 3 clicked"); })();' ]);?>
    <?php ActiveForm::end(); ?>

</div>
