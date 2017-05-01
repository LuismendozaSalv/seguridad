<?php
include_once('../other/conexion.php');

$fechaIni = $_GET['fechaIni'];
	$fechaFin = $_GET['fechaFin'];
	$idEmp = $_GET['idEmpresa'];

	$query="Select c.codigocuenta, c.descripcion, SUM(d.debe) as Debito, SUM(d.haber) as Credito,  SUM(d.debe)-SUM(d.haber) as Deudor, SUM(d.debe)-SUM(d.haber) as Acreedor 
			from cuenta as c, asiento as a, detalleasiento as d
			where c.codigocuenta = d.codigo_Cuenta and a.idAsiento = d.id_Asiento
      		and fecha BETWEEN '$fechaIni' and '$fechaFin' and c.id_Empresa= $idEmp
			group by c.codigocuenta";

	$query2= "Select SUM(d.debe) as TotalDebito, SUM(d.haber) as TotalCredito
			  from cuenta as c, asiento as a, detalleasiento as d
			  where c.codigocuenta = d.codigo_Cuenta and a.idAsiento = d.id_Asiento
      		  and fecha BETWEEN '$fechaIni' and '$fechaFin' and c.id_Empresa= $idEmp";

	$resultado=$gbd->query($query);
	$resultado2=$gbd->query($query2);
	$deudorTotal = 0;
	$acreedorTotal = 0;
?>

<html>
	<head>
		<title>Balance Sumas y Saldos</title>
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
  background: #606060;
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
	<body>
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
				$('#test').attr('download', 'Balance de Sumas y Saldos.xls');
			}

		}
	</script>

	<button class="btn btn-info" onclick="window.print();" name="imprimir"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
	<button class="btn btn-warning"><a href="#" id="test" onClick="javascript:fnExcelReport();">Exportar en EXCEL</a> <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
	<div id="cuadro">
		<center><br>
		<div id="titulo">
		<center><h1>Balance de Comprobación de Sumas y Saldos</h1></center>
		</div>

		<table id="myTable">
			<thead>

			<tr class="centro">
					<td><h3>Codigo de Cuenta</td>
					<td><h3>Descripcion</td>
					<td><h3>Debito</td>
					<td><h3>Credito</td>
					<td><h3>Deudor</td>
					<td><h3>Acreedor</td>
				</tr>
				<tbody>
					<?php while($row=$resultado->fetch()){ ?>
						<tr>
							<td><?php echo $row['codigocuenta'];?>
							</td>
							<td>
								<?php echo $row['descripcion'];?>
							</td>
							<td>
								<?php echo $row['Debito'];?>
							</td>
							<td>
								<?php echo $row['Credito'];?>
							</td>
							<td>
								<?php ;
								if($row['Deudor']>0) {
								    $deudorTotal += $row['Deudor'];
									echo $row['Deudor'];
								}
								else echo 0;?>
							</td>
							<td>
								<?php
								if($row['Acreedor']<0) {
									$acreedorTotal += ($row['Acreedor']) * -1;
									echo $row['Acreedor'] * -1;
								}
								else echo 0;?>
							</td>
						</tr>
					<?php } ?>
					<?php while($row2=$resultado2->fetch()){ ?>
						<tr>
							<td>
							</td>
							<td><h3><?php echo 'Total'?></h3>
							</td>
							<td><?php echo $row2['TotalDebito'];?>
							</td>
							<td>
								<?php echo $row2['TotalCredito'];?>
							</td>
							<td>
								<?php echo $deudorTotal;?>
							</td>
							<td>
								<?php echo $acreedorTotal;?>
							</td>



						</tr>
					<?php } ?>
				</tbody>
			</table>
			<table>
				<thead>

				</thead>

				<tbody>

				</tbody>
			</table>
			</center>
		</div>
		</body>
	</html>
