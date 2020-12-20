<?php   
require '../cuenta/compruebaVentas.php';
require '../clases/Chango.php';	
require '../clases/Cliente.php';
require '../clases/Ventas.php';
require '../clases/ProductosCh.php';	

$objChango = new Chango();
$objCliente = new Cliente();
$objProductoCh = new ProductosCh();
$objWonderlist = new Wonderlist();
$objVentas = new Ventas();

## VARIABLES QU SIRVEN ##
if(isset($_POST['idChango'])){
    if(is_numeric($_POST['idChango'])){     
$idChango = $_POST['idChango'];
        $mostrarEstado = $objChango->mostrarEstado($idChango);
        foreach($mostrarEstado as $mE){
$estado = $mE['estadoVenta'];
$idCliente = $mE['nombreCliente'];
}}}
############################


//AGREGA DESCUENTO TEMPORAL
if(isset($_POST['descuento'])){
    $descTemporal = $_POST['descuento'];
    $descTemporal = trim($descTemporal);
    $editarDescTemporal = $objChango ->editarDescTemporal($idChango, $descTemporal);      

    header("location:chango.php?changoNumero=".$idChango);
}


//ESTO BORRA EL CHANGUITO ENTERO
    if(isset($_GET['nombreChango'])){
        $nombreChanguito = $_GET['nombreChango'];
        if(is_numeric($nombreChanguito)){

            if($_GET['bolean'] == 'no'){
            ?>
            <div class="borrasionesAlerta">
                <p> ¿Estas seguro que quiere borrar el chango "<?php echo $nombreChanguito; ?>"? </p>

                <a href="nuevaVenta.php">
                            NO, volver </a>

                <a href="changoManejo.php?nombreChango=<?php echo $nombreChanguito;?>&bolean=si"> 
                            SI, borrar </a>
            </div>
<?php       }else{
              $borrarProductosChango = $objProductoCh -> borrarProductosChango($nombreChanguito);
              $borrarChango = $objChango ->borrarChango($nombreChanguito); 
              header("location:nuevaVenta.php"); 
            }
        }
    }
  


//CAMBIO DE ESTADO (PROCESO A PENDIENTE)
if(isset($_POST['cambioEstado'])){
if($_POST['cambioEstado'] == 'true'){

            $mostrarProductos = $objProductoCh ->mostrarProductosxCh($idChango);    

            foreach($mostrarProductos as $mp){
                if($mp['unidad'] == 'Pack x6'){
                    $cantidad = $mp['cantidad'] * 6;
                }else{
                    $cantidad = $mp['cantidad'];
                }
                $marca = $mp['marca'];
                $tipo = $mp['tipo'];
            
            $mostrarStock = $objWonderlist ->mostrarStock($marca, $tipo);
                foreach($mostrarStock as $ms){
                    $cantidadResultado = $ms['stock'] - $cantidad;
                }
            $cambioStock = $objWonderlist ->cambioStock($marca, $tipo, $cantidadResultado);  
            }
        
        $cambioEstado = $objChango ->cambioEstado($idChango);
        header("location:../panel.php"); 
}}



//Finalizar Venta
        ## Comprovaciones basicas para finalizar la venta
if(isset($_POST['finalizarVenta'])){
if($_POST['finalizarVenta'] == 'true'){
if($estado == 'pendiente'){
       
        ## Traigo los datos del lugar para la venta
    $DatosClienteXid = $objCliente ->mostrarDatosCliente($idCliente);          
    foreach($DatosClienteXid as $dcxn){
            $lugarForeach = $dcxn['lugar'].'-'.$dcxn['lugarDos'].'-'.$dcxn['lugarTemporal'];
            $clienteForeach = $dcxn['nombreCliente'];
    }

        ## Traigo los datos de los productos 
    $mostrarProductos = $objProductoCh ->mostrarProductosxCh($idChango);  
    $productosForeach = "";
    foreach($mostrarProductos as $mp){
            $productosForeach = $productosForeach.$mp['marca'].' '.$mp['tipo'].' ('.$mp['cantidad'].' '.$mp['unidad'].')<br>';
    }

$nombreCliente = $clienteForeach;
$productos = $productosForeach;
$lugar = $lugarForeach;
$valorTotal = $_POST['valorTotal'];
$fecha = date('Y-m-d');


#Agrego la venta con los datos anteriormente recuperados
$agregarVenta = $objVentas ->agregarVenta($nombreCliente, $productos, $valorTotal, $lugar, $fecha);   

#Saco el lugar temporal del cliente
$lugarVacio = '';
$editarLugarTemporal = $objCliente ->editarLugarTemporal($idCliente, $lugarVacio);   

#Borro los productos del chango
$borrarProductos = $objProductoCh->borrarProductosChango($idChango);
#Para finalizar borro el chango
$borrarChangoFfinal = $objChango ->borrarChangoFfinal($idChango);   

header("location:../panel.php"); 

}}}



// CANCELA VENTA
if(isset($_POST['cancelarVenta'])){
if($_POST['cancelarVenta'] == 'true'){
if($estado == 'pendiente'){

#$idChango = $_POST['idChango'];
#$estado = $mE['estadoVenta'];
#$idCliente = $mE['nombreCliente'];

    if($_GET['confirm'] == 'no'){
        $texto = '¿Estas seguro que quiere cancelar la venta?';
        $no = 'chango.php??changoNumero='.$idChango;
        $si = '<form action="changoManejo.php?confirm=si" method="POST">
        <input type="hidden" name="cancelarVenta" value="true">
        <input type="hidden" name="idChango" value="'.$idChango.'">
        <input type="submit" value="Cancelar este chango" class="alertConfirm">
        </form>';
        require '../alertas/confirm.php';
    }else{
    $mostrarProductos = $objProductoCh ->mostrarProductosxCh($idChango);    
        foreach($mostrarProductos as $mp){
            if($mp['unidad'] == 'Pack x6'){
                $cantidad = $mp['cantidad'] * 6;
            }else{
                $cantidad = $mp['cantidad'];
            }
            $marca = $mp['marca'];
            $tipo = $mp['tipo'];
        }
        $mostrarStock = $objWonderlist ->mostrarStock($marca, $tipo);
        foreach($mostrarStock as $ms){
            $cantidadWonder = $ms['stock'];
            $cantidadResultado = $ms['stock'] + $cantidad;
        }

        #esto cambia el stock
        $cambioStock = $objWonderlist ->cambioStock($marca, $tipo, $cantidadResultado); 
        #esto borra los productos del chango
        $borrarProductos = $objProductoCh -> borrarProductosChango($idChango);
        #esto borra el chango
        $borrarChango = $objChango -> borrarChangoFfinal($idChango);
        header("location:../panel.php"); 
    } 

}}}
/*

//Cancelar venta
if(isset($_GET['nombreCancelar'])){
    $nombreCancelar = $_GET['nombreCancelar'];
    if($_GET['bolean'] == 'no'){
        ?>
        <div class="borrasionesAlerta">
            <p> ¿Estas seguro que quiere cancelar esta venta? Esto borrara todo este chango </p>

            <a href="../panel.php">
                        NO, volver </a>

            <a href="borrasiones.php?nombreCancelar=<?php echo $nombreCancelar;?>&bolean=si"> 
                        SI, borrar </a>
        </div>
<?php }else{

$objStock = new Chango();
$mostrarProductos = $objStock ->mostrarProductos($nombreCancelar);    

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
        $cantidadResultado = $ms['stock'] + $cantidad;
    }
$objStockP2 = new Wonderlist();
$cambioStock = $objStockP2 ->cambioStock($marca, $tipo, $cantidadResultado); 

}


 $objBorrarChango = new Chango();
 $borrarChangoFfinal = $objBorrarChango ->borrarChangoFfinal($nombreCancelar);
}
}
*/

?>


<!DOCTYPE html>
<head>
<meta name="googlebot" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/verVentas.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Subir precios</title>
</head>
<body>
    
    
    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
</body>
</html>