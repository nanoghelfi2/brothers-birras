<!DOCTYPE html>
<?php   
require '../cuenta/compruebaVentas.php';		

$objWonderlistId = new Wonderlist();

//ESTO PARA BORRAR
if(isset($_POST['idBorrar'])){
    $idBorrar = $_POST['idBorrar'];
    $confBorrar = $_GET['borrar'];
        if($confBorrar == 'no'){ 
            $mostrarWonderlistxID = $objWonderlistId ->mostrarWonderlistxID($idBorrar); ?>
            <div class="alertaConfirmar">
                <b> ¿Esta seguro que quiere borrar este producto? <br> 
                    <?php  foreach($mostrarWonderlistxID as $mwlid){
                        echo $mwlid['marca'].' - '.$mwlid['tipo'];
                    }?></b>

                <div class="botons">
                    <form action="cambiosWonderlist.php?borrar=si" method="post">  
                        <input type="hidden" name="idBorrar" value="<?php echo $idBorrar; ?>">
                        <input type="submit" value="SI, borrar" class="acept"> 
                    </form>
                    <form action="editarWonderlist.php" method="post"> 
                        <input type="hidden" name="producto" value="<?php echo $idBorrar; ?>">
                        <input type="submit" value="NO, volver" class="deny"> 
                    </form>
                </div>
            </div>
            
 <?php  }else if($confBorrar == 'si'){
            $objBorrar = new Wonderlist();
            $borrarProd = $objBorrar ->borrarProducto($idBorrar);
            header("location:verWonderlist.php?marca=todas");
        }
}


//ESTO ES PARA EDITAR DATOS
if(isset($_POST['idEditar'])){
    $idEditar   = $_POST['idEditar'];
//Cambio marca
$nuevaMarca = $_POST['nuevaMarca'];
    $nuevaMarca = trim($nuevaMarca);
if($nuevaMarca == '' || $nuevaMarca == ' '){
    echo 'No se realizo cambios en la Marca <br>';
}else{
   $objCambioMarca = new Wonderlist();
   $cambioMarca = $objCambioMarca ->cambioMarca($idEditar, $nuevaMarca);}

//Cambio tipo
$nuevoTipo  = $_POST['nuevoTipo'];
    $nuevoTipo = trim($nuevoTipo);
if($nuevoTipo == '' || $nuevoTipo == ' '){
    echo 'No se realizo cambios en el Tipo <br>';
}else{
   $objCambioTipo = new Wonderlist();
   $cambioTipo = $objCambioTipo ->cambioTipo($idEditar, $nuevoTipo);}

//Cambio costo
$nuevaCosto = $_POST['nuevaCosto'];
    $nuevaCosto = trim($nuevaCosto); 
if($nuevaCosto == '' || $nuevaCosto == ' '){
    echo 'No se realizo cambios en el Costo <br>';
}else{
   $objCambioCosto = new Wonderlist();
   $cambioCosto = $objCambioCosto ->cambioCosto($idEditar, $nuevaCosto);}

//Cambio Venta por unidad
$nuevaVxU   = $_POST['nuevaVxU'];
    $nuevaVxU = trim($nuevaVxU);    
if($nuevaVxU == '' || $nuevaVxU == ' '){
    echo 'No se realizo cambios en la venta x unidad <br>';
}else{
   $objCambioVxU = new Wonderlist();
   $cambioVentaU = $objCambioVxU ->cambioVentaU($idEditar, $nuevaVxU);}


//Cambio Venta por Pack
$nuevaVxP   = $_POST['nuevaVxP'];
    $nuevaVxP = trim($nuevaVxP);
if($nuevaVxP == '' || $nuevaVxP == ' '){
    echo 'No se realizo cambios en la venta x Pack <br>';
}else{
    $objCambioVxP = new Wonderlist();
    $cambioVentaP = $objCambioVxP ->cambioVentaP($idEditar, $nuevaVxP);}

//Cambio stock
$nuevaStock = $_POST['nuevaStock'];
    $nuevaStock = trim($nuevaStock);
if($nuevaStock == '' || $nuevaStock == ' '){
    echo 'No se realizo cambios en el Stock <br>';
}else{
    $objCambioStock = new Wonderlist();
    $cambioStockId = $objCambioStock ->cambioStockId($idEditar, $nuevaStock);}
?>

    <form action="editarWonderlist.php" method="post" class="VolverProducto"> 
        <input type="hidden" name="producto" value="<?php echo $idEditar; ?>">
        <input type="submit" value="VOLVER AL PRODUCTO"> 
    </form>

<?php
}
?>

<html lang="en">
<head>
<meta name="googlebot" content="noindex">
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/negociosComp.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocios</title>
</head>
<body>




    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
</body>
</html>