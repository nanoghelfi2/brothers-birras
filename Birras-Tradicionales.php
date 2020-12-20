<?php
require 'private/clases/Conexion.php';
require 'private/clases/Wonderlist.php';		
require 'php/verifEdad.php';	
require 'private/clases/ProductosPag.php';	

$objMostrarMarcas= new Wonderlist();
$objPpal= new ProductosPag();
$tipoCerveza = 'Industrial';
$mostrarMarcasTipo = $objMostrarMarcas ->mostrarMarcasTipo($tipoCerveza); 
?>
<!DOCTYPE html>
<html lang="en">
<style>.menuTradicionales{background-color: rgb(51, 49, 44); }</style>
<head>
    <link  rel="icon"   href="img/BrothersBirra.svg" type="image/png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/birrasTradicionales.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>Brothers Birras - Cervezas Tradicionales</title>
    <meta name="description" content="¿Te gustan los sabores clasicos? Aca tambien tienes un espacio para ti, mira todos las cervezas que tenemos. Te las llevamos a tu casa!">
</head>
<body>
<?php include 'template/header.php'; ?>

<section class="introduccion">
    <h1> Cervezas Tradicionales </h1>

    <p> ¿Te gustan los sabores clasicos? </p>

    <p class="animate"> Nosotros te la llevamos a tu casa </p>

    <p class="textproductos">
      En <b> Brothers birras</b> tambien pensamos en vos. Por eso, te presentamos una amplia variedad de marcas de las birras clasicas para que las puedas disfrutar en cualquier momento <br>
        A continuacion te mostramos todos los tipos que tenemos, y si te intereso alguna, dirigite a <a href="Pedidos-y-contactos.php"> PEDIDOS Y CONTACTOS </a>para enterarte de sorteos, <a href="">SEGUINOS</a> en nuestras redes.
    </p>
</section>

<section class="productos">
<p style="font-size:110%;font-weight:bold;margin-left:1%;text-align:center;">
<i>Los siguientes productos vienen en PACK de 6 (un.)</i></p>

    <?php foreach($mostrarMarcasTipo as $mm){?>
        <section class="producto">
            <p class="marcaProducto"> <?php echo $mm['marca'];?> </p>

                <?php
                $tipoMarca = $mm['marca'];
                $mostrarTiposDos = $objMostrarMarcas ->mostrarMarcasTipoDos($tipoMarca);
                foreach($mostrarTiposDos as $mmd){  
                    $precioVenta = $mmd['precioPack'];
                    $idWl = $mmd['id'];
                    $stockDisp = $mmd['stock'];

                    if($stockDisp < 6){
                        $stockText = '<span id="sinStock"> Sin stock disponible </span>';
                    }
                    if($stockDisp >= 6 & $stockDisp < 12){
                        $stockText = '<span id="ultimoSt"> ¡Ultimo pack disponible! </span>';
                    }
                    if($stockDisp >= 12 & $stockDisp < 18){
                        $stockText = '<span id="pocoSt"> ¡Ultimos 2 packs disponible! </span>';
                    }
                    if($stockDisp >= 18 & $stockDisp < 24){
                        $stockText = '<span id="pocoSt"> ¡Ultimos 3 packs disponible! </span>';
                    }
                    if($stockDisp >= 24){
                        $stockText = '<span id="dispStock"> Stock disponible </span>';
                    }
                    
                    $mostrarDatos = $objPpal ->mostrarPrincipal($idWl);
                    foreach($mostrarDatos as $md){
                ?>
                    <div>
                        <p class="tipoProducto"> 
                            <?php echo $md['titulo'];?>: 
                        </p> 
                      
                        <p class="precioProdcto">
                            $ <?php echo $precioVenta;?>
                        </p>
                    </div>
                    <p class="stockDisp">
                            Stock: <?php echo $stockText?> 
                    </p>
        <div class="pAddCartMob">
                <section>
                    <img src="img/carritov2.svg" alt="" class="imgCart">
                </section>     <b>: </b>                                        
                <form action="aprobarProducto.php" method="post" name="formulario" class="addCarrito">
                    <input type="hidden" name="marca" value="<?php echo $mm['marca']; ?>">
                    <input type="hidden" name="tipo" value="<?php echo $md['titulo']; ?>">
                    <input type="hidden" name="precio" value="<?php echo $precioVenta; ?>">
                    <input type="hidden" name="unidad" value="Pack">
                        <input type="number" name="cantidad" value="1" min="1" max="<?php echo $stockDisp / 6; ?>" class="cantidad" requiere> Pack
                    <input type="submit" value="Agregar" class="enviar">
                </form>
        </div>
                <?php } } ?>


            </section>
    <?php }?>

</section>


<?php include 'template/footer.php'; ?>
</body>
</html>