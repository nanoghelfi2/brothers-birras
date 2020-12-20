<?php 
require '../private/clases/Conexion.php';
require '../private/clases/Wonderlist.php';		
require '../private/clases/ProductosPag.php';	
#require '../php/verifEdad.php';	

if(isset($_GET['Num'])){
    $numBirra = $_GET['Num'];
    if(is_numeric($numBirra)) {
        $idBirra = $numBirra;
    }else{echo 'Lo siento, hubo un error. <a href="../index"> VOLVER </a>';}
}else{echo 'Lo siento, hubo un error. <a href="../index"> VOLVER </a>';}

$objWonderlist = new Wonderlist();
$objPpal= new ProductosPag();
$mostrarInfo1 = $objWonderlist ->mostrarPOID($idBirra);
$mostrarInfo2 = $objPpal ->mostrarBirra($idBirra);
foreach($mostrarInfo1 as $mi1){
    $precio = $mi1['precioVenta'];
    $stock = $mi1['stock'];
    $marca = $mi1['marca'];
}
foreach($mostrarInfo2 as $mi2){
    $titulo = $mi2['titulo'];
    $descripcion = $mi2['descripcion'];
    $estilo = $mi2['estilo'];
    $imagen = $mi2['imgGrande'];
    $envase = $mi2['envase'];
}
//manejo del stock
if($stock > 6){
    $textoStock = '<span id="disponible">Stock disponible</span>';
}
if($stock == 6){
    $textoStock = '<span id="cinco">Ultimas 6 unidades! Aprovechalas</span>';
}
if($stock == 5){
    $textoStock = '<span id="cinco">Ultimas 5 unidades! Aprovechalas</span>';
}
if($stock == 4){
    $textoStock = '<span id="cuatro">Solo quedan 4 unidades! Aprovechalas</span>';
}
if($stock == 3){
    $textoStock = '<span id="ultimas">Solo quedan 3 unidades! ¿Te las vas a perder?</span>';
}
if($stock == 2){
    $textoStock = '<span id="ultimas">Solo quedan 2 unidades! ¿Te las vas a perder?</span>';
}
if($stock == 1){
    $textoStock = '<span id="ultimas"> Solo queda 1! NO TE LA PIERDAS </span>';
}
if($stock < 1){
    $textoStock = '<span id="ultimas"> Sin stock disponible </span>';
}
?>
<!DOCTYPE html>
<head>
    <script src="../js/sumCart.js"></script>
    <link  rel="icon"   href="../img/BrothersBirra.svg" type="image/png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/birra.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Brothers Birras ➡ Cervezas: </title>
    <meta name="description" content="">
</head>
<body>
<?php include 'template/header.php'; ?>

<section class="birra">
    <div class="birraImg">
        <img src="../<?php echo $imagen ?>" alt="<?php echo $titulo; ?>">
    </div>
    <div class="birraInfo">
        <h1><?php echo $titulo; ?></h1>
        <h2>Marca: <?php echo $marca; ?></h2>
        <p><b>Estilo:</b> <?php echo $estilo; ?>.</p>
        <p><b>Precentacion:</b> <?php echo $envase; ?>.</p>
        <p><b>Precio:</b> $<?php echo $precio; ?> c/u.</p>
        <p><b>Stock:</b> <?php echo $textoStock; ?>.</p>


<div class="pAddCart"> 
                        <p><img src="../img/carritov2.svg" alt=""> 
                        <b>Cantidad:</b> </p>  
    <form action="../aprobarProducto.php" method="post" name="formularioDesk" class="addCarrito">
                <input type="hidden" name="marca" value="<?php echo $marca; ?>">
                <input type="hidden" name="tipo" value="<?php echo $titulo; ?>">
                <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                <input type="hidden" name="unidad" value="Unidades">
        <input type="button" value="-" onClick="addDesk(-1);" class="botonCant">
            <input type="number" name="cantidadDesk" value="1" value="1" min="1" max="<?php echo $stock; ?>" class="cantidad" require>
        <input type="button" value="+" onClick="addDesk(1);" class="botonCant">

        <input type="submit" value="Agregar al carrito" class="enviar">
    </form>
</div>

        <p id="descripcion"><?php echo $descripcion; ?></p>
    </div>
</section>
<h1 class="tituloMobile"><?php echo $titulo; ?></h1>
<section class="birraMobile">
    <div class="birraImg">
        <img src="../<?php echo $imagen ?>" alt="<?php echo $titulo; ?>">
    </div>
    
    <div class="birraInfo">
        <h2>Marca: <?php echo $marca; ?></h2>
        <p><b>Estilo:</b> <?php echo $estilo; ?>.</p>
        <p><b>Precentacion:</b> <?php echo $envase; ?>.</p>
        <p><b>Precio:</b> <?php echo $precio; ?>.</p>
        <p><b>Stock:</b> <?php echo $textoStock; ?>.</p>
    </div>


<div class="pAddCartMob"> 
                        <p><img src="../img/carritov2.svg" alt=""> 
                        <b>Cantidad:</b> </p>  
    <form action="../aprobarProducto.php" method="post" name="formulario" class="addCarrito">
                <input type="hidden" name="marca" value="<?php echo $marca; ?>">
                <input type="hidden" name="tipo" value="<?php echo $titulo; ?>">
                <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                <input type="hidden" name="unidad" value="Unidades">
        <input type="button" value="-" onClick="add(-1);" class="botonCant">
            <input type="number" name="cantidad" value="1" value="1" min="1" max="<?php echo $stock; ?>" class="cantidad" require>
        <input type="button" value="+" onClick="add(1);" class="botonCant">

        <input type="submit" value="Agregar al carrito" class="enviar">
    </form>
</div>

    <p id="descripcion"><?php echo $descripcion; ?></p>
    
</section>


    <a href="../Carrito" class="pedido"> ¿Como funciona el carrito? <br> ¿Como hacer una compra? <br>Click aqui!  </a>

<?php include 'template/footer.php'; ?>
</body>
</html>
