<head>
<meta name="googlebot" content="noindex">
</head>
<?php 
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];


//$usuario = $mysqli->real_escape_string($usuario);
//$contraseña = $mysqli->real_escape_string($contraseña);
if($usuario == null || $usuario == ' ' || $contraseña == null || $contraseña == ' '){
	header("Location: isnError.php"); die();
	die();
}


if(!substr_count($usuario, ' ')> 0){
	if(!substr_count($usuario, '>')> 0){
		if(!substr_count($usuario, '<')> 0){
			if(!substr_count($usuario, '"')> 0){
				if(!substr_count($usuario, ',')> 0){
					if(!substr_count($usuario, '-')> 0){
						if(!substr_count($usuario, '|')> 0){
							if(!substr_count($usuario, '/')> 0){
								if(!substr_count($usuario, "'")> 0){
									}	else {header("Location: isnError.php"); die();}	
								}	else {header("Location: isnError.php"); die();}	
							}	else {header("Location: isnError.php"); die();}	
						}	else {header("Location: isnError.php"); die();}	
					}	else {header("Location: isnError.php"); die();}	
				}	else {header("Location: isnError.php"); die();}	
			}	else {header("Location: isnError.php"); die();}
	}	else {header("Location: isnError.php"); die();}
}	else {header("Location: isnError.php"); die();}

if(!substr_count($contraseña, ' ')> 0){
	if(!substr_count($contraseña, '>')> 0){
		if(!substr_count($contraseña, '<')> 0){
			if(!substr_count($contraseña, '"')> 0){
				if(!substr_count($contraseña, ',')> 0){
					if(!substr_count($contraseña, '-')> 0){
						if(!substr_count($contraseña, '|')> 0){
							if(!substr_count($contraseña, '/')> 0){
								if(!substr_count($contraseña, "'")> 0){
									}	else {header("Location: isnError.php"); die();}	
								}	else {header("Location: isnError.php"); die();}	
							}	else {header("Location: isnError.php"); die();}	
						}	else {header("Location: isnError.php"); die();}	
					}	else {header("Location: isnError.php"); die();}	
				}	else {header("Location: isnError.php"); die();}	
			}	else {header("Location: isnError.php"); die();}
	}	else {header("Location: isnError.php"); die();}
}	else {header("Location: isnError.php"); die();}


require '../clases/Conexion.php';
require '../clases/Wonderlist.php';
$objDios = new Wonderlist(); 	
$usuarios  = $objDios ->usuario($usuario, $contraseña);	


if($usuarios>0){
	session_start();
	$_SESSION['usuario'] = $usuario;
	$_SESSION['contraseña'] = $contraseña;	
	header("Location: ../panel.php");
} else{
header("Location: isnError.php"); die();
}

?>