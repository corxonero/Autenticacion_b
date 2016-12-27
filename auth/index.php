<?php
/** 
* @file
* \brief Inicio de la aplicación
* \details Pantalla de inicio de la aplicación. Añade cabeceras, muestra 
* los mensajes de error de logAttempt.php y define la estructura del layout.
* \author auth.agoraUS
*/

include_once 'variables.php';
require_once "Facebook/autoload.php";

session_start();

$fb = new Facebook\Facebook([
  'app_id' => FB_APP_ID, // 4 Replace {app-id} with your app id
  'app_secret' => FB_APP_SECRET,
  'default_graph_version' => FB_APP_VERSION,
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://beta.authb.agoraus1.egc.duckdns.org/fb-callback.php', $permissions);


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
		
		<?php echo'<input onClick="location.href = \''.  htmlspecialchars($loginUrl) .'\'"
		id="loginDNIe" 
                            type="button"
                            value ="Entra" 
                           	class="btn btn-info"/>'; ?>


		
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
