<?php
	
	
	$mysqli=new mysqli("46.101.12.5","kleber","123456","contaBeta"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>