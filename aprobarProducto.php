<meta name="googlebot" content="noindex">
<?php
$aCarrito = array();
$sHTML = '';
$fPrecioTotal = 0;


//Esto vacia el carrito
if(isset($_GET['vaciar'])) {
	unset($_COOKIE['carrito']);
}

//Obtenemos los productos anteriores
if(isset($_COOKIE['carrito'])) {
    #$aCarrito = unserialize($_COOKIE['carrito']);
    $aCarrito = json_decode($_COOKIE['carrito'], true);
}


//Borrar un producto
if(isset($_GET['borrarProducto'])){
if(is_numeric($_GET['borrarProducto'])){
    $idDel = $_GET['borrarProducto'];
    unset($aCarrito[$idDel]);

}}


//Agregamos el nuevo articulo
if(isset($_POST['marca']) & isset($_POST['tipo'])){
    if(isset($_POST['cantidad'])){
        $cantidad = $_POST['cantidad'];
    }
    if(isset($_POST['cantidadDesk'])){
        $cantidad = $_POST['cantidadDesk'];
    }
if(is_numeric($cantidad)){
if($cantidad > 0){
    $marca = $_POST['marca'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $unidad = $_POST['unidad'];

$producto = count($aCarrito);
$aCarrito[$producto]['marca'] = $marca;
$aCarrito[$producto]['tipo'] = $tipo;
$aCarrito[$producto]['precio'] = $precio;
$aCarrito[$producto]['cantidad'] = $cantidad;
$aCarrito[$producto]['unidad'] = $unidad;

}else{
    echo 'Debe elegir al menos un producto.';
}}}

//Creamos la cookie (serializamos)
$iTemCad = time() + 2880;
#setcookie('carrito', serialize($aCarrito), $iTemCad);
setcookie('carrito', json_encode($aCarrito), $iTemCad);


 header("Location: Carrito"); 
?>

