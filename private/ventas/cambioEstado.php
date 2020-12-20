<?php   
require '../cuenta/compruebaVentas.php';
require '../clases/Ventas.php';	
require '../clases/Chango.php';	
require '../clases/Cliente.php';


$nombreCliente = $_GET['nombre'];
$marca = '';

$objStock = new Chango();
$mostrarProductos = $objStock ->mostrarProductos($nombreCliente);    

foreach($mostrarProductos as $mp){
    if($mp['unidad'] == 'Pack x6'){
        $cantidad = $mp['cantidad'] * 6;
    }else{
        $cantidad = $mp['cantidad'];
    }
    $marca = $mp['marca'];
    $tipo = $mp['tipo'];

$objStockP1 = new Wonderlist();
$mostrarStock = $objStockP1 ->mostrarStock($marca, $tipo);
    foreach($mostrarStock as $ms){
        $cantidadResultado = $ms['stock'] - $cantidad;
    }
$objStockP2 = new Wonderlist();
$cambioStock = $objStockP2 ->cambioStock($marca, $tipo, $cantidadResultado); 

}


$objEstado = new Chango();
$cambioEstado = $objEstado ->cambioEstado($nombreCliente);           
   


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="googlebot" content="noindex">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/verVentas.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
<title>cambio estado</title>
</head>
<body>
<a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a> 
</body>
</html>