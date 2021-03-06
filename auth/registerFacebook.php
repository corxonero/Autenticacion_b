<?php
/** 
* @file
* \brief Registro en la aplicación
* \details Pantalla de registro en la aplicación. Añade cabeceras, muestra 
* los mensajes de error de action_register.php y define la estructura del layout.
* \author auth.agoraUS
*/

//Esta es la página de registro mediando autenticación con Facebook

include_once("database.php");
session_start();

?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="shortcut icon" href="favicon.ico">
    
    <meta charset="utf-8">
    <link rel="stylesheet" href="layout.css" />
    <script src="lib/jquery-2.1.1.min.js"></script>
    
    <script type="text/javascript" src="style/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="style/bootstrap/js/bootstrap.mi.js"></script>
    <script type="text/javascript" src="style/bootstrap/js/npm.js"></script>
    
    <link rel="stylesheet" href="style/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="style/bootstrap/css/bootstrap-theme.css" type="text/css">
    <link rel="stylesheet" href="style/bootstrap/css/bootstrap-theme.css.map" type="text/css">
    <link rel="stylesheet" href="style/bootstrap/css/bootstrap.css.map" type="text/css">
    
    <link rel="stylesheet" href="style/style.css" type="text/css">
    
    <title><?php echo TITLE?></title>
    <script type="text/javascript">
        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"
            ))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-z
            A-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function form_process(){
            var errores = false;
            $('#error').html("");
            if ($('#username').val() == undefined || $('#username').val() == "") {
                errores = true;
                $('#error').html($('#error').html() + "-Debe elegir un nombre de usuario<br>");
            } else if ($('#username').val().length < 5) {
                errores = true;
                $('#error').html($('#error').html() + 
                    "-El nombre de usuario es demasiado corto (mínimo 5 caracteres)<br>");
            }
            if ($('#password').val() == undefined || $('#password').val() == "") {
                errores = true;
                $('#error').html($('#error').html() + "-Debe elegir una contraseña<br>");
            } else if ($('#password').val().length < 5) {
                errores = true;
                $('#error').html($('#error').html() + "-La contraseña es demasiado corta (mínimo 5 caracteres)<br>");
            } else if ( $('#r_password').val() == undefined ||
                $('#r_password').val() == "" ||
                $('#password').val() != $('#r_password').val()) {
                errores = true;
                $('#error').html($('#error').html() + "-Las contraseñas no coinciden<br>");
            }
            if ($('#name').val() == undefined || $('#name').val() == "") {
                errores = true;
                $('#error').html($('#error').html() + "-Debe elegir un nombre<br>");
            }
            if ($('#surname').val() == undefined || $('#surname').val() == "") {
                errores = true;
                $('#error').html($('#error').html() + "-Debe elegir unos apellido<br>");
            }
            if ($('#email').val() == undefined || $('#email').val() == "") {
                errores = true;
                $('#error').html($('#error').html() + "-Debe indicar una dirección de correo electrónico.<br>");
            } else if (!validateEmail($('#email').val())) {
                errores = true;
                $('#error').html($('#error').html() + "-La dirección de correo electrónico no es válida<br>");
            }
            if ($('#genre').val() == undefined || $('#genre').val() == "" || $('#genre').val() == "default" ) {
                errores = true;
                $('#error').html($('#error').html() + "-Debe elegir un género<br>");
            }
            if ($('#age').val() == undefined || $('#age').val() == "") {
                errores = true;
                $('#error').html($('#error').html() + "-Debe elegir una edad<br>");
            } else if ($('#age').val() < 1) {
                error = true;
                $('#error').html($('#error').html() + "-La edad no es válida<br>");
            }
            if ($('#autonomous_community').val() == undefined ||
                $('#autonomous_community').val() == "" || 
                $('#autonomous_community').val() == "default" ){
                errores = true;
            $('#error').html($('#error').html() + "-Debe elegir una comunidad autónoma<br>");
        }
        return !errores;
    }
</script>
<?php
if (!isset($_SESSION['registerForm'])) {
    $registerForm['username'] = "";
    $registerForm['password'] = "";
    $registerForm['name'] = $_POST['nombre'];
    $registerForm['surname'] =$_POST['apellido'];
    $registerForm['email'] = $_POST['email'];
    $registerForm['age'] = "";
} else {
    $registerForm = $_SESSION['registerForm'];
}

$_SESSION['registerForm'] = $registerForm;
?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
 
 <div class="tituloInicio">Formulario de Registro</div>
 

 <div id="error" class="errores">
    <br>
    <?php
    if (isset($_REQUEST['error'])) {
        $error = $_REQUEST['error'];
        if ($error % 2 != 0) {
            echo "Error al insertar en la base de datos.<br>";
            $error--;
        }
        if ($error >= 95072) {
            echo "Debe introducir sus apellidos.<br>";
            $error -= 95072;
        }
        if ($error >= 47536) {
            echo "Debe introducir un nombre.<br>";
            $error -= 47536;
        }
        if ($error >= 23768) {
            echo "La edad no es válida.<br>";
            $error -= 23768;
        }
        if ($error >= 16384) {
            echo "Debe introducir una edad.<br>";
            $error -= 16384;
        }
        if ($error >= 8192) {
            echo "La comunidad autónoma no es válida.<br>";
            $error -= 8192;
        }
        if ($error >= 4096) {
            echo "Debe elegir una comunidad autónoma.<br>";
            $error-=4096;
        }
        if ($error >= 2048) {
            echo "El género no es válido.<br>";
            $error -= 2048;
        }
        if ($error >= 1024) {
            echo "Debe elegir un género.<br>";
            $error -= 1024;
        }
        if ($error >= 512) {
            echo "El email ya está registrado.<br>";
            $error -= 512;
        }
        if ($error >= 256) {
            echo "La dirección de correo electrónico no es válida.<br>";
            $error -= 256;
        }
        if ($error >= 128) {
            echo "Debe indicar una dirección de correo electrónico.<br>";
            $error -= 128;
        }
        if ($error >= 64) {
            echo "Las contraseñas no coinciden.<br>";
            $error -= 64;
        }
        if ($error >= 32) {
            echo "La contraseña es demasiado corta (mínimo 5 caracteres).<br>";
            $error -= 32;
        }
        if ($error >= 16) {
            echo "Debe elegir una contraseña.<br>";
            $error -= 16;
        }
        if ($error >= 8) {
            echo "Ese nombre de usuario ya existe.<br>";
            $error -= 8;
        }
        if ($error >= 4) {
            echo "El nombre de usuario es demasiado corto (mínimo 5 caracteres).<br>";
            $error -= 4;
        }
        if ($error >= 2) {
            echo "Debe elegir un nombre de usuario.<br>";
            $error -= 2;
        }
    }
    ?>
    <br>
</div>


<div align="left">
    <form id="registerForm" onsubmit="return form_process()" method="POST" action="action_register.php" class="styleForm">
        <br>
        <br>

        <label for="username" class="labelForm"> <i class="glyphicon glyphicon-user"></i> Nombre de usuario:</label>
        <input  type="text" id="username" name="username" class="inputForm" value=<?php echo htmlentities($registerForm['username']) ?>>
        
        <br>

        <label for="email" class="labelForm"><i class="glyphicon glyphicon-envelope"></i> Correo electrónico:</label>
        <input  type="text" id="email" name="email" class="inputForm" value=<?php echo htmlentities($registerForm['email']) ?>>
        
        <br />
        <br />
        
        <label for="password" class="labelForm"> <i class="fa fa-lock"></i> Contraseña:</label>
        <input  type="password" id="password" name="password" class="inputForm" />
        
        <br>

        <label for="r_password" class="labelForm"> <i class="fa fa-lock"></i> Repetir Contraseña:</label>
        <input  type="password" id="r_password" name="r_password" class="inputForm" />
        
        <br />
        <br />
        
        <label for="name" class="labelForm">Nombre:</label>
        <input  type="text" id="name" name="name" class="inputForm" value=<?php echo htmlentities($registerForm['name']) ?>>
        
        <br>

        <label for="surname" class="labelForm">Apellidos:</label>
        <input  type="text" id="surname" name="surname" class="inputForm" value=<?php echo htmlentities($registerForm['surname']) ?>>

        <br>

        <label for="genre" class="labelForm">Género:</label>
        <select id="genre" name="genre" class="inputForm">
            <option value="default">----------</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select>  

        <br>              
        
        <label for="age" class="labelForm">Edad: </label>
        <input  type="number" 
        id="age" 
        name="age" 
        min="1" 
        class="inputForm" 
        value=<?php echo htmlentities($registerForm['age'])?>>
        
        <br>

        <label for="autonomous_community" class="labelForm">Comunidad autónoma:</label>
        <select name="autonomous_community" id="autonomous_community" class="inputForm"> 
            <option value="default" selected="true">----------</option>
            <option value="Andalucia">Andalucia</option>
            <option value="Murcia">Murcia</option>
            <option value="Extremadura">Extremadura</option>
            <option value="Castilla la Mancha">Castilla la Mancha</option>
            <option value="Comunidad Valenciana">Comunidad Valenciana</option>
            <option value="Madrid">Madrid</option>
            <option value="Castilla y Leon">Castilla y Leon</option>
            <option value="Aragon">Aragon</option>
            <option value="Cataluña">Cataluña</option>
            <option value="La Rioja">La Rioja</option>
            <option value="Galicia">Galicia</option>
            <option value="Asturias">Asturias</option>
            <option value="Cantabria">Cantabria</option>
            <option value="Pais Vasco">Pais Vasco</option>
            <option value="Navarra">Navarra</option>
        </select>

        <input type="text" name="role" id="role" class="inputForm" value="USUARIO" hidden="true" />
        <input type="text" name="urlAnterior" id="urlAnterior" class="inputForm" value=<?php echo $_SERVER['REQUEST_URI']; ?> hidden="true" />
        

        <br>
        <br>
        <br>
        
        <div align="center">  
        <input type="reset" value="Borrar"  class="btn btn-info">

            <input  type="submit" 
            id="submit" 
            value ="Enviar" 
            class="btn btn-info" align="center"/>
        </div> 

         <br><br>
      <a href="logout.php?Cancelar=true" value="Cancelar" name="Cancelar" class="btn btn-cancelar">Cancelar</a>
       
        
        
        
    </form>
</div>
<br />
<br />
<div class="push"></div>
<div align="left">
    <div class="footer">
        <i class="glyphicon glyphicon-copyright-mark"></i><b>Copyright</b>
    </div>
</diV>
</body>
</html>