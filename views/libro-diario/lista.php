<?php
//var_dump();
//exit();
use kartik\export\ExportMenu;
use yii\data\ActiveDataProvider;
use yii\db\mysql\QueryBuilder;
use yii\db\Query;

include_once('../other/conexion.php');

$fechaIn = $_GET['fechaIni'];
	$fechaFin = $_GET['fechaFin'];
	$idEmp = $_GET['idEmpresa'];

//	require('conexion.php');
	
	$query="Select d.codigo_Cuenta, c.descripcion,a.fecha, a.idAsiento,a.glosa, d.debe, d.haber
			from cuenta as c,asiento as a, detalleasiento as d
			where c.codigoCuenta = d.codigo_Cuenta and a.idAsiento = d.id_Asiento and fecha BETWEEN '$fechaIn' and '$fechaFin' and c.id_Empresa= $idEmp
			order by d.codigo_Cuenta";
	

	$resultado=$mysqli->query($query);

?>

<html>

	<head>
		<title>Libro Diario</title>

<style type="text/css">


/* Datagrid */
	body {
  font: normal medium/1.4 sans-serif;
  background: linear-gradient( 0deg, #C0C0C0   , #F8F8F8);}
table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  padding: 0.25rem;
  border: 1px solid #ccc;
}
tbody tr:nth-child(odd) {
  background: #eee;
}
.centro{
  padding: 0.5rem;
  background: #484848 ;
  color: white;
  text-align: center;
  font-size: 21px;

}

#cuadro{
	width: 90%;
	background: #F8F8F8 ;
	padding: 25px;
	margin: 5px auto;
	border: 3px solid #D8D8D8;
}
#titulo{
	width: 100%;
	background: #282828;
	color:white;

}

	</style>
	</head>
	<script>function fnExcelReport() {
	var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
	tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';

						tab_text = tab_text + '<x:Name>Test Sheet</x:Name>';

						tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
					tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

	tab_text = tab_text + "<table border='1px'>";
		tab_text = tab_text + $('#myTable').html();
		tab_text = tab_text + '</table></body></html>';

	var data_type = 'data:application/vnd.ms-excel';

	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");

	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
	if (window.navigator.msSaveBlob) {
	var blob = new Blob([tab_text], {
	type: "application/csv;charset=utf-8;"
	});
	navigator.msSaveBlob(blob, 'Test file.xls');
	}
	} else {
	$('#test').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
	$('#test').attr('download', 'Libro Diario.xls');
	}

	}
		</script>
<!--	<input type="button"  class="btn btn-primary"name="imprimir" value="Imprimir P&aacute;gina" onclick="window.print();">-->
	<body>
	<button class="btn btn-info" onclick="window.print();" name="imprimir"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
<button class="btn btn-warning"><a href="#" id="test" onClick="javascript:fnExcelReport();">Exportar en EXCEL</a> <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
	<div id="cuadro">
		<center><br>
		<div id="titulo">
		<center><h1>Libro Diario</h1></center>
		</div>



			<div >
		<table id="myTable">
			<thead>
				<tr class="centro">
					<td><h3>Codigo</td>
					<td><h3>Cuenta</td>
					<td><h3>Fecha</td>
					<td><h3>Asiento</td>
					<td><h3>Glosa</td>
					<td><h3>Debe</td>
					<td><h3>Haber</td>

				</tr>
				<tbody>
					<?php while($row=$resultado->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row['codigo_Cuenta'];?>
							</td>
							<td>
								<?php echo $row['descripcion'];?>
							</td>
							<td>
								<?php echo $row['fecha'];?>
							</td>
							<td>
								<?php echo $row['idAsiento'];?>
							</td>
							<td>
								<?php echo $row['glosa'];?>
							</td>
							<td>
								<?php echo $row['debe'];?>
							</td>
							<td>
								<?php echo $row['haber'];?>
							</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
			</center>
		</div>
		</body>
	
	</html>
