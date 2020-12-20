<?php   
require '../cuenta/compruebaVentas.php';
require '../clases/Ventas.php';	
require '../clases/Chango.php';	
require '../clases/Cliente.php';	

$objMostrarClientes = new Cliente();
$mostrarNombresClientes = $objMostrarClientes ->mostrarNombresClientes();   



$nombreC = $_POST['nombreCliente'];
$contactoU = $_POST['contactoUno'];
$contactoDos = $_POST['contactoDos'];
$lug = $_POST['lugar'];
$lugarDos = $_POST['lugarDos'];

if($nombreC == ''){
    header('Location: datosCliente.php?error=');
}else{
    $nombreCliente = $nombreC;}
if($contactoU == ''){
    header('Location: datosCliente.php?error=');
}else{
    $contactoUno = $contactoU;}  
if($lug == ''){
    header('Location: datosCliente.php?error=');
}else{
    $lugar = $lug;} 

$contactoDos = $_POST['contactoDos'];
$lugarDos = $_POST['lugarDos'];

print_r($_POST);
/*$objagregarCliente = new Cliente();
$agregarCliente = $objagregarCliente ->agregarCliente($nombreCliente, $contactoUno, $contactoDos, $lugar, $lugarDos);   

*/
?>
<!DOCTYPE html>
<head>
<meta name="googlebot" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/verVentas.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Guardar cliente</title>
</head>
<body>



    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
</body>
</html>