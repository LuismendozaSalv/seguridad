<?php
use yii\helpers\Html;
include_once('../other/conexion.php');
	$codCta = $_GET['codCuenta'];
		$fechaIn = $_GET['fechaIni'];
		$fechaFin = $_GET['fechaFin'];
		$idEmp = $_GET['idEmpresa'];



			$query="Select a.fecha, a.idAsiento,a.glosa,  d.debe, d.haber , d.debe - d.haber as Saldo
			from cuenta as c,asiento as a, detalleasiento as d
			where c.codigoCuenta = d.codigo_Cuenta and a.idAsiento = d.id_Asiento and 
			fecha BETWEEN '$fechaIn' and '$fechaFin' and c.id_Empresa= $idEmp and c.codigoCuenta = $codCta
			order by idAsiento";

			$query2=" Select SUM(d.debe) as debito, SUM(d.haber) as credito, SUM(d.debe)-SUM(d.haber) as Saldo
			from cuenta as c,asiento as a, detalleasiento as d
			where c.codigoCuenta = d.codigo_Cuenta and a.idAsiento = d.id_Asiento and 
			fecha BETWEEN '$fechaIn' and '$fechaFin' and c.id_Empresa= $idEmp and c.codigoCuenta = $codCta
			order by idAsiento";

  			$resultado=$mysqli->query($query);
			$resultado2=$mysqli->query($query2);
			$query3 = "Select descripcion from cuenta where codigoCuenta = $codCta";
			$resultado3 = $mysqli->query($query3);
			$s = $resultado3->fetch_assoc();
			$cta = $s['descripcion'];
$this->title = 'Libro Mayor Cuenta : '. $cta	;
$periodo = 'Periodo: ' . $fechaIn .' - ' .$fechaFin;
?>
<h1><?= Html::encode($this->title) ?></h1>
<h2><?= Html::encode($periodo) ?></h2>
<html>
	<head>
		<title>Libro Mayor</title>
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
				$('#test').attr('download', 'Libro Mayor.xls');
			}

		}
	</script>
	
	<button class="btn btn-info" onclick="window.print();" name="imprimir"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
	<button class="btn btn-warning"><a href="#" id="test" onClick="javascript:fnExcelReport();">Exportar en EXCEL</a> <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
	<body>

	<div id="cuadro">
		<center><br>
		<div id="titulo">
		<center><h1>Libro Mayor </h1></center>
		</div>
		
		<table id="myTable">
			<thead>
				<tr class="centro">

					<td><h3>Fecha</td>
					<td><h3>Asiento Nº</td>
					<td><h3>Glosa</td>
					<td><h3>Debito</td>
					<td><h3>Credito</td>
					<td><h3>Saldo</td>
				</tr>
			</thead>
				<tbody>
					<?php while($row = $resultado->fetch_assoc()){ ?>
						<tr>
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
							<td>
								<?php echo $row['Saldo'];?>
							</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
			<table>
				<thead>

				</thead>

				<tbody>
				<?php while($row2=$resultado2->fetch_assoc()){ ?>
					<tr>

						<td><?php echo 'Total'?>
						</td>
						<td><?php echo $row2['debito'];?>
						</td>
						<td>
							<?php echo $row2['credito'];?>
						</td>
						<td>
							<?php echo $row2['Saldo'];?>
						</td>


					</tr>
				<?php } ?>
				</tbody>
			</table>
			</center>
		</div>
		</body>
	</html>
