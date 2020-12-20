<?php  
require '../cuenta/compruebaVentas.php';
require '../clases/Chango.php';	
require '../clases/ProductosCh.php';

$objChango= new Chango();
$objProductosCh= new ProductosCh();
$objWonderlist= new Wonderlist();

        //Por post, siempre tiene que llegar un id del chango para obtener diferentes datos, como puede ser el estado del mismo
    if(isset($_POST['idChango'])){
$idChango = $_POST['idChango']; //VARIABLE ID DE CHANGO 
    }else{ ?>
    <a href="../panel.php" class="volverInicio"> 
        <p>Volver al panel inicio</p> 
    </a> 
    <?php die('No se encontro id del chango, no se puede continuar. Comuncarse con Luciano');}

    $mostrarEstado = $objChango->mostrarEstado($idChango);
    foreach($mostrarEstado as $me){
$estado = $me['estadoVenta'];   //VARIABLE ESTADO DEL CHANGO
$idCliente = $me['nombreCliente']; //VARIABLE ID DEL CLIENTE
    }

?>

<head>
<meta name="googlebot" content="noindex">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/verVentas.css">
<link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>


<a href="chango.php?changoNumero=<?php echo $idChango;?>" class="volverInicio" style="bottom:60px;background-color: mediumspringgreen;"> 
    <p>Volver al Chango</p> 
</a>
<a href="../panel.php" class="volverInicio"> 
    <p>Volver al panel inicio</p> 
</a>


<?php
    //BORRAR UN PRODUCTO DE UN CHANGO
        //detectamos si llega el ID del producto a borrar por POST
            if(isset($_POST['idProductoBorrar'])){ 
                $idBorrar = $_POST['idProductoBorrar'];
                //si existe la id a borrar, tenemos que preguntar si estamos seguros
                if(isset($_GET['confirm'])){
                    $confirm = $_GET['confirm'];
                    //comprobamos si el confirm es si
                    if($confirm == 'si'){
                            //Ahora, si el estado del chango es pendiente, tenemos que agregar al stock del wonderlist y luego quitar el producto
                            if($estado == 'pendiente'){
                                                        
                            $datosProducto = $objProductosCh->mostrarProductosxId($idBorrar);
                            foreach($datosProducto as $dp){
                                $marcaProd = $dp['marca'];
                                $tipoProd = $dp['tipo'];                    
                                if($dp['unidad'] == 'Pack x6'){ //si es un pack, multipla x6 la cnatidad
                                $cantidadProd = $dp['cantidad'] * 6;
                                    }else{
                                $cantidadProd = $dp['cantidad'];
                                }
                            }    

                            $mostrarStock = $objWonderlist ->mostrarStock($marcaProd, $tipoProd);
                            foreach($mostrarStock as $msp){
                                $cantidadActual = $msp['stock'];
                                $cantidadResultado = $cantidadActual + $cantidadProd;
                            }

                            //Esto cambia el stock del producto a quitar del chango
                            $cambioStock = $objWonderlist ->cambioStock($marcaProd, $tipoProd, $cantidadResultado); 
                            }
                    //Y esto borra el producto, sea el estado en que este el chango
                    $borrarProducto = $objProductosCh ->borrarProducto($idBorrar); 
                    header("location:chango.php?changoNumero=".$idChango);  
                    //Esto es si la confirmacion no existe, o  si es diferente a SI
                    }else{ 
                      header("location:chango.php?changoNumero=".$idChango);}
                }else{
                    $texto = '¿Estas seguro que quiere borrar este producto?';
                    $no = 'chango.php??changoNumero='.$idChango;
                    $si = '<form action="productoManejo.php?confirm=si" method="POST">
                    <input type="hidden" name="idProductoBorrar" value="'.$idBorrar.'">
                    <input type="hidden" name="idChango" value="'.$idChango.'">
                    <input type="submit" value="Borrar este producto" class="alertConfirm">
                    </form>';
                    require '../alertas/confirm.php';
                }
            }


?>
