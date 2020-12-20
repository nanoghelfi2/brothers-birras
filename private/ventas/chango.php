<?php   
require '../cuenta/compruebaVentas.php';
require '../clases/Ventas.php';	
require '../clases/Chango.php';	
require '../clases/Cliente.php';	
require '../clases/ProductosCh.php';

//llamamos a los objetos que vamos a utilizas
$objChango = new Chango();
$objCliente= new Cliente();
$objProductosCh= new ProductosCh();

//ESTO SE EJECUTA UNA SOLA VEZ CUANDO PASO DATOS DEL CLIENTE PARA CREAR CHANGO
if(isset($_GET['newChangoClient'])){
    if(is_numeric($_GET['newChangoClient'])){
$idCliente = $_GET['newChangoClient'];
if($idCliente == ''){header('Location: nuevaVenta.php?error1=true');
}elseif($idCliente == '-'){header('Location: nuevaVenta.php?error1=true');
}else{
    $nuevoChango = $objChango ->nuevoChango($idCliente);}
}else{header('Location: nuevaVenta.php?error1=true');}
} //FIN, AHORA TENGO QUE TABAJAR SOLO CON EL ID DEL CHANGO

//Aca obtengo el id del chango que viene por GET y pido el Id del cliente y el estado
if(isset($_GET['changoNumero'])){
    if(is_numeric($_GET['changoNumero'])){
        $changoNumero = $_GET['changoNumero'];
        $mostrarEstado = $objChango ->mostrarEstado($changoNumero);
        foreach($mostrarEstado as $mE){
            $idClienteBD = $mE['nombreCliente'];
            $estadoBD = $mE['estadoVenta'];}
        }else{echo 'error al obtener el numero del chango';}
} //Luego de obtener los datos, lo almaceno en variables mas prolijas abajo
$idChango = $changoNumero;
$idCliente = $idClienteBD;
$estado = $estadoBD;


$mostrarDescuento = $objChango ->mostrarDescuento($idChango);
$sum = 0;
$desc = 0;
foreach($mostrarDescuento as $dsc){
    if($dsc['descuento'] == '' || $dsc['descuento'] == NULL || $dsc['descuento'] == ' '){
    $desc = 0;
        }else{
             $desc = $dsc['descuento'];
            }
    //$idDesc = $dsc['idcliente'];
}


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
<script src="../js/despliega.js"></script>
<body>
<div class="cabezeraChango">  
<a href="nuevaVenta.php" class="botonAtras"> <img src="../img/flecha.svg" alt=""> Atras </a>  
<p>Chango numero: <?php echo $idChango; ?></p>
</div>  

<div class="contenedorBotones">
<div class="botonChango botonProductos" onclick="productos()">
            <p> PRODUCTOS Y PRECIOS</p>
</div>

<div class="botonChango botonCliente" onclick="cliente()">
            <p> CLIENTE Y ENTREGA </p>
</div>
</div>

<div class="contenedorProducto">
<center><p><b>Productos:</b></p></center>
    <?php  
    $mostrarProductos = $objProductosCh-> mostrarProductosxCh($idChango);
        foreach($mostrarProductos as $mp){ ?>
            <div class="mostrarProductos">   
                <p> <?php echo $mp['marca']; ?>  </p>
                <p> <?php echo $mp['tipo']; ?>  </p>
                <p> x <?php echo $mp['cantidad']; ?>  </p>
                <p> (<?php echo $mp['unidad']; ?>)  </p>
                <p> $ <?php echo $mp['valor']; ?></p>  
            </div>
            <?php $sum+= $mp['valor']; ?>
            <form action="productoManejo.php" method="POST">
                <input type="hidden" name="idProductoBorrar" value="<?php  echo $mp['idprod'] ?>">
                <input type="hidden" name="idChango" value="<?php  echo $idChango ?>">
                <input type="submit" value="Borrar este producto" class="mostrarProductosBorrar">
            </form>
    <?php } ?><br>

    Descuento actual : $ <?php echo $desc;  
    $valorTotal = $sum - $desc;?> <br>
    <form action="changoManejo.php" method="post" class="descuentoForm">
        <input type="hidden" name="idChango" value="<?php echo $idChango; ?>">
        Agregar descuento: <input type="number" name="descuento"> <input type="submit">
    </form>
    <p class="negrita">VALOR TOTAL: $ <?php echo $valorTotal; ?> </p>

    <form action="agregarProducto.php" method="POST">
            <input type="hidden" name="idChango" value="<?php  echo $idChango; ?>">
            <input type="submit" value="+ Agregar Producto" class="agregarProducto">
    </form>   
</div>



<div class="lugarEntrega">
        <center><p style="margin-bottom:5%;"><b>Datos de entrega: </b></p></center>
    <?php    
    $mostrarDatosCliente = $objCliente->mostrarDatosCliente($idCliente);
    foreach($mostrarDatosCliente as $mdc){ ?>
        <p>    Nombre Cliente :  <?php echo $mdc['nombreCliente'];        ?>  </p> 
        <p>    Contacto 1 :      <?php echo $mdc['contacto'];      ?>  </p>
        <p>    Contacto 2 :      <?php echo $mdc['contactoDos'];   ?>  </p>
        <p>    Lugar 1 :         <?php echo $mdc['lugar'];         ?>  </p>
        <p>    Lugar 2 :         <?php echo $mdc['lugarDos'];      ?>  </p>
        <p>    Lugar Temporal :  <?php echo $mdc['lugarTemporal'];      ?>  </p>
       
    <?php  $nombreDelCliente = $mdc['nombreCliente'];
    }
    ?>

    <form action="clienteManejo.php" method="post" class="entregaTemporal">
        <p> Cambiar el lugar de entrega temporal: </p>
        <input type="text" name="lugarTemporal">

        <input type="hidden" name="idChango" value="<?php echo $idChango; ?>">
        <input type="submit" value="Cambiar" style="width:30%;align-self:flex-end;margin-bottom:1%;">
    </form>
    <form action="clienteManejo.php" method="post" class="cambioDeCliente">
            <input type="hidden" name="cambiarElCliente" value="true">
            <input type="hidden" name="idChango" value="<?php echo $idChango; ?>">
            Cambiar de cliente: 
                        <select name="cliente" require>
                        <option> - </option>
                        <?php 
                        $mostrarNombresClientes = $objCliente ->mostrarNombresClientes();  
                        foreach($mostrarNombresClientes as $mnc){?>
                        <option value="<?php echo $mnc['idcliente']; ?>"> 
                            <?php echo $mnc['nombreCliente']; ?> 
                        </option>
                    <?php } ?>
                        </select>
                        <input type="submit" value="Cambiar">
    </form>
</div>



<?php
if($nombreDelCliente != '1) CALCULADORA'){
//ACA COMPRUEBO QUE, SI ESTADO ESTA EN PROCESO, PUEDA CONFIRMAR EL PEDIDO
    if($estado == 'proceso'){ ?>
    <div style="margin:5% 0 15% 0; border-top:2px solid black;">
        <p style="text-align: center; margin-bottom:3%;margin-top:1%;">
        <b>Confirmar pedido y pasar a entregas pendientes</b> 
        </p>
        <form action="changoManejo.php" method="post">
            <input type="hidden" name="cambioEstado" value = "true">
            <input type="hidden" name="idChango" value="<?php echo $idChango; ?>">
            <input type="submit" value="¡Confirmar!" class="agregarProducto2">
        </form>
        <br>
        <p>Un vez que se haga click en confirmar, el chango pasa a un estado de venta de Entrega Pendiente, estas se podran observar en el panel principal
        </p>
    </div>
<?php } ?>


<?php //ACA COMPRUEBO QUE, SI ESTADO ESTA EN PENDIENTE, PUEDA FINALIZAR EL PEDIDO
    if($estado == 'pendiente'){ ?>
<div style="margin:5% 0 5% 0; border-top:2px solid black;">
        <p class="negrita" style="text-align: center; margin-bottom:3%;">
        Para dar por finalizada esta venta haga click abajo: </p>

        <form action="changoManejo.php" method="post">
            <input type="hidden" name="finalizarVenta" value="true">
            <input type="hidden" name="valorTotal" value="<?php echo $valorTotal; ?>">
            <input type="hidden" name="idChango" value="<?php echo $idChango; ?>">
            <input type="submit" value="¡Finalizar!" class="agregarProducto2 agregarProducto3">
        </form>
</div>


    <div style="margin:5% 0 15% 0;">
        <p class="negrita" style="text-align: center; margin-bottom:3%;">
        ¿Algo ha salido mal? Puedes cancelar la venta: </p>
 
        <form action="changoManejo.php?confirm=no" method="post">
            <input type="hidden" name="cancelarVenta" value="true">
            <input type="hidden" name="idChango" value="<?php echo $idChango; ?>">
            <input type="submit" value="Cancelar" class="agregarProducto2 agregarProducto4">
        </form>

    </div>

<?php }} ?>


    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
</body>
</html> 