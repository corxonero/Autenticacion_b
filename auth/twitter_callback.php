<?php
 
require_once 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
 
session_start();
 
$config = require_once 'configTwitter.php';

$oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');
 
if (empty($oauth_verifier) ||
    empty($_SESSION['oauth_token']) ||
    empty($_SESSION['oauth_token_secret'])
) {
    // something's missing, go and login again
    header('Location: ' . $config['url_login']);
}

// connect with application token
$connection = new TwitterOAuth(
    $config['consumer_key'],
    $config['consumer_secret'],
    $_SESSION['oauth_token'],
    $_SESSION['oauth_token_secret']
);
 
// request user token
$token = $connection->oauth(
    'oauth/access_token', [
        'oauth_verifier' => $oauth_verifier
    ]
);

$twitter = new TwitterOAuth(
    $config['consumer_key'],
    $config['consumer_secret'],
    $token['oauth_token'],
    $token['oauth_token_secret']
);
$params = array('include_email' => 'true', 'include_entities' => 'true', 'skip_status' => 'true');

$status = $twitter->get('account/verify_credentials', $params);

$nombre = $status->name . PHP_EOL;
$username = $status->screen_name;

include_once("database.php");

?>

<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="shortcut icon" href="favicon.ico">
    
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
    


    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    
<title>Entra con Twitter</title>
</head>
<body>

        <div class="tituloInicio">Entra con Twitter</div>


        <form name="myForm" action="registerTwitter.php" method="post">
        <br><br>
        <div class="textoNormal">¿Esta seguro de registrarse en nuestra aplicación <?php echo htmlentities($nombre)?>?</div>
        <input type="hidden" name="username" value=<?php echo $username?>>
        <input type="hidden" name="name" value=<?php echo $nombre?>>
       
         <input type="reset" value="Borrar"  class="btn btn-info">
         <input type="submit" value="Confirmar"  class="btn btn-info">
        </form>
        
        <br><br>
        <a href="logout.php" value="Cancelar" name="Cancelar" class="btn btn-cancelar">Cancelar</a>
</body>
</html>
