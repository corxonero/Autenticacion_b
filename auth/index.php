<?php
/** 
* @file
* \brief Inicio de la aplicación
* \details Pantalla de inicio de la aplicación. Añade cabeceras, muestra 
* los mensajes de error de logAttempt.php y define la estructura del layout.
* \author auth.agoraUS
*/

include_once 'variables.php';

?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
	
	<script type="text/javascript" src="style/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="style/bootstrap/js/bootstrap.mi.js"></script>
	<script type="text/javascript" src="style/bootstrap/js/npm.js"></script>
	<script type="text/javascript" src="style/bootstrap/js/index.js"></script>
	
	<!-- esto hace referencia a algo que no existe -->
	<script type="text/javascript" src="scripts/index.js"></script>
	
	<link rel="stylesheet" href="style/style.css" type="text/css">

	
	<link rel="stylesheet" href="style/bootstrap/css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="style/bootstrap/css/bootstrap-theme.css" type="text/css">
	<link rel="stylesheet" href="style/bootstrap/css/bootstrap-theme.css.map" type="text/css">
	<link rel="stylesheet" href="style/bootstrap/css/bootstrap.css.map" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title><?php echo TITLE?></title>
</head>
<body>
	
	<div class="tituloInicio">¡Bienvenidos a agor@us!</div>
	
	<div class="principal">
	  <div class="col-md-4">
		<h1>Entrar con Facebook</h1>
		<input  onClick="location.href = 'loginFacebook.php' "
                            id="loginDNIe" 
                            type="button"
                            value ="Entra" 
                           	class="btn btn-info"/>
	  </div>

	  <div class="col-md-4">
		<h1>Entrar sin DNIe</h1>
		<input  onClick="location.href = 'loginNotDNIe.php' "
                            id="loginNotDNIe" 
                            type="button"
                            value ="Entra" 
                           	class="btn btn-info"/>
	  </div>
	  
	  <div class="col-md-4">
		<h1>¿Aún no te has registrado?</h1>
		<input  onClick="location.href = 'register.php' "
                            id="register" 
                            type="button"
                            value ="Registrate" 
                           	class="btn btn-info"/>
	  </div>
	</div>
	
	
</body>
</html>
