<?php 
require '../clases/Conexion.php';
require '../clases/Wonderlist.php';


session_start();
$comprueba = $_SESSION['usuario'];
if($comprueba == NULL || $comprueba == ' '){
	header("location:../cuenta/isn.php");
	die();
}
?>

<a href="../cuenta/csn.php" id="volver" style="bottom:0%; width: 100px;position: fixed;right: 0%; background-color: orange;padding: 0.5%; border:1px solid black;"> <h4> <center> Cerrar Sesion </center> </h4> </a>