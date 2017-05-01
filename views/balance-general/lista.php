<?php
include_once('../other/conexion.php');

$fechaIni = $_GET['fechaIni'];
	$fechaFin = $_GET['fechaFin'];
	$idEmp = $_GET['idEmpresa'];

$query="Select c.codigocuenta, c.descripcion,  SUM(d.debe) as Debito, SUM(d.haber) as Credito
			from cuenta as c, asiento as a, detalleasiento as d
			where c.codigocuenta = d.codigo_Cuenta and a.idAsiento = d.id_Asiento and codigocuenta like '1.%'
      		and fecha BETWEEN '$fechaIni' and '$fechaFin' and c.id_Empresa= $idEmp
			group by c.codigocuenta";


$query2="Select c.codigocuenta, c.descripcion, SUM(d.debe) as Debito, SUM(d.haber) as Credito,  SUM(d.debe)-SUM(d.haber) as TotalCuentaPasivo
			from cuenta as c, asiento as a, detalleasiento as d
			where c.codigocuenta = d.codigo_Cuenta and a.idAsiento = d.id_Asiento and codigocuenta like '2.%'
      		and fecha BETWEEN '$fechaIni' and '$fechaFin' and c.id_Empresa= $idEmp
			group by c.codigocuenta";
$query3="Select c.codigocuenta, c.descripcion, SUM(d.debe) as Debito, SUM(d.haber) as Credito,  SUM(d.debe)-SUM(d.haber) as TotalCuentaCapital
			from cuenta as c, asiento as a, detalleasiento as d
			where c.codigocuenta = d.codigo_Cuenta and a.idAsiento = d.id_Asiento and codigocuenta like '3.%'
      		and fecha BETWEEN '$fechaIni' and '$fechaFin' and c.id_Empresa= $idEmp
			group by c.codigocuenta";

	$resultado=$mysqli->query($query);
	$resultado2=$mysqli->query($query2);
$resultado3=$mysqli->query($query3);
	$TotalCuentaActivo	 = 0;
$TotalCuentaPasivo= 0;
$TotalCuentaCapital = 0;


?>

<html>
	<head>
		<title>Balance General</title>
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
				$('#test').attr('download', 'Balance General.xls');
			}

		}
	</script>

	<button class="btn btn-info" onclick="window.print();" name="imprimir"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
	<button class="btn btn-warning"><a href="#" id="test" onClick="javascript:fnExcelReport();">Exportar en EXCEL</a> <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>

	<body>
<div id="cuadro">
		<center><br>
		<div id="titulo">
		<center><h1>Balance General</h1></center>
		</div>
		
		<table id="myTable">
			<thead>
				<tr class="centro">
					<td><h3>Codigo de Cuenta</td>
					<td><h3>Descripcion</td>

					<td><h3>Total de Cuenta</td>
					<td><h3>SubTotal</td>
					<td><h3>Total</td>
				</tr>
				<tbody>
					<?php while($row=$resultado->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row['codigocuenta'];?>
							</td>
							<td>
								<?php echo $row['descripcion'];?>
							</td>
							<td>
								<?php ;
								if(($row['Debito']-$row['Credito'])>0) {
									$TotalCuentaActivo +=($row['Debito']-$row['Credito']);
									echo ($row['Debito']-$row['Credito']);
								}
								else echo 0;?>
							</td>

						</tr>
					<?php } ?>
					<tr>
						<td>
						</td>
						<td><strong>SubTotal Activos</strong>
						</td>
						<td>=====>
						</td>
						<td><?=$TotalCuentaActivo?>
						</td>
					</tr>

					<tr>
						<td>
						</td>
						<td>
						</td>
						<td><strong>Total Activos</strong>
						</td>
						<td>=====>
						</td>
						<td><?=$TotalCuentaActivo?>
						</td>
					</tr>

					<?php while($row=$resultado2->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row['codigocuenta'];?>
							</td>
							<td>
								<?php echo $row['descripcion'];?>
							</td>
							<td>
								<?php ;
								if((($row['Credito']-$row['Debito']))>0) {
									$TotalCuentaPasivo +=(($row['Credito']-$row['Debito']));
									echo (($row['Credito']-$row['Debito']));
								}
								else echo 0;?>
							</td>

						</tr>
					<?php } ?>

					<tr>
						<td>
						</td>
						<td><strong>SubTotal Pasivos</strong>
						</td>
						<td>=====>
						</td>
						<td><?=$TotalCuentaPasivo?>
						</td>
					</tr>

					<?php while($row=$resultado3->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row['codigocuenta'];?>
							</td>
							<td>
								<?php echo $row['descripcion'];?>
							</td>
							<td>
								<?php ;
								if((($row['Credito']-$row['Debito']))>0) {
									$TotalCuentaCapital +=(($row['Credito']-$row['Debito']));
									echo (($row['Credito']-$row['Debito']));
								}
								else echo 0;?>
							</td>
						</tr>
					<?php } ?>

					<tr>
						<td>
						</td>
						<td><strong>SubTotal Capital</strong>
						</td>
						<td>=====>
						</td>
						<td><?=$TotalCuentaCapital?>
						</td>
					</tr>

					<tr>
						<td>
						</td>
						<td>
						</td>
						<td><strong>Total Pasivo + Capital</strong>
						</td>
						<td>=====>
						</td>
						<td><?=$TotalCuentaCapital+$TotalCuentaPasivo?>
						</td>
					</tr>

				</tbody>
			</table>

			</center>
		</div>
		</body>
	</html>
