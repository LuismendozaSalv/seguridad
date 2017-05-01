?php
include_once('../other/conexion.php');
	
	$query="Select d.codigo_Cuenta, c.descripcion,a.fecha, a.idAsiento,a.glosa, d.debe, d.haber, a.id_Empresa
			from cuenta as c,asiento as a, detalleasiento as d
			where c.codigoCuenta = d.codigo_Cuenta and a.idAsiento = d.id_Asiento order by idAsiento";

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
	<body>
	<input type="button"  class="btn btn-primary"name="imprimir" value="Imprimir P&aacute;gina" onclick="window.print();">
	<div id="cuadro">
		<center><br>
		<div id="titulo">
		<center><h1>Libro Diario</h1></center>
		</div>
		
		<table>
			<thead>
				<tr class="centro">
					<td>codigo_Cuenta</td>
					<td>descripcion</td>
					<td>fecha</td>
					<td>idAsiento</td>
					<td>glosa</td>
					<td>debe</td>
					<td>haber</td>
					<td>Empresa</td>
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
							<td>
								<?php echo $row['id_Empresa'];?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>	
			</center>
		</div>
		</body>
	</html>
