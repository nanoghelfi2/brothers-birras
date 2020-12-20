<!DOCTYPE html>
<?php   
require '../cuenta/compruebaVentas.php';		

$producto = $_POST['producto'];

if($producto == '' || $producto == NULL){
    header("location:verWonderlist.php?marca=todas");
}

$objWonderlistId = new Wonderlist();
$mostrarWonderlistxID = $objWonderlistId ->mostrarWonderlistxID($producto); 


?>

<head>
<meta name="googlebot" content="noindex">
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/negociosComp.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocios</title>
</head>
<body>
<?php foreach($mostrarWonderlistxID as $marca){ ?>  
<a href="verWonderlist.php?marca=<?php echo $marca['marca']; ?>" class="botonAtras"> <img src="../img/flecha.svg" alt=""> Atras </a>
<?php } ?>    

        <div class="datosExistentes">
        <b> Datos actuales: </b>
        <?php foreach($mostrarWonderlistxID as $mwli){ ?>
            <p> Marca = <?php echo $mwli['marca']; ?> </p>
            <p> Tipo = <?php echo $mwli['tipo']; ?> </p>
            <p> Costo = $ <?php echo $mwli['precioCompra']; ?> </p>
            <p> Venta x Unidad = $ <?php echo $mwli['precioVenta']; ?> </p>
            <p> Venta Pack = $ <?php echo $mwli['precioPack']; ?> </p>
            <p> Stock = <?php echo $mwli['stock']; ?> </p>
        <?php } ?>
    </div>
    <div class="borrarExistente">
        ¿Desea borrar este producto?
            <form action="cambiosWonderlist.php?borrar=no" method="post">
                <input type="hidden" name="idBorrar" value="<?php echo $producto; ?>">
                <input type="submit" value="BORRAR" class="botonBorrar">
            </form>
    </div>

    <div class="editarExistente">
             <b>¡Editar datos! </b>  

        <form action="cambiosWonderlist.php" method="post" class="cambiosWonderlist">
            <input type="hidden" name="idEditar" value="<?php echo $producto; ?>">
            <p><label> Marca =            </label>  <input type="text" name="nuevaMarca"> </p>
            <p><label> Tipo =             </label>  <input type="text" name="nuevoTipo"> </p>
            <p><label> Costo = $          </label>  <input type="number" name="nuevaCosto"> </p>
            <p><label> Venta x Unidad = $ </label>  <input type="number" name="nuevaVxU"> </p>
            <p><label> Venta x Pack = $   </label>  <input type="number" name="nuevaVxP"> </p>
            <p><label> Stock = Un.        </label>  <input type="number" name="nuevaStock"> </p>

                <input type="submit" value="REALIZAR CAMBIOS" class="boton">
        </form>    
    </div>

    <b><i>¡ATENCION!</i></b> Los campos que queden vacios no se modificaran en el producto. Es decir, quedaran con su informacion actual.

    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>

</body>
</html>