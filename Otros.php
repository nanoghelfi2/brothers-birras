<?php
require 'private/clases/Conexion.php';
require 'private/clases/Wonderlist.php';		
require 'php/verifEdad.php';	
require 'private/clases/ProductosPag.php';
$objPpal= new ProductosPag();
$objMostrarMarcas= new Wonderlist();
$tipoCerveza = 'Otros';
$mostrarMarcasTipo = $objMostrarMarcas ->mostrarMarcasTipo($tipoCerveza); 
?>
<!DOCTYPE html>
<html lang="en">
<style>.menuOtros{background-color: rgb(51, 49, 44); }</style>
<head>
    <link  rel="icon"   href="img/BrothersBirra.svg" type="image/png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/birrasTradicionales.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>Otras Bebidas</title>
</head>
<body>
<?php include 'template/header.php'; ?>

<section class="introduccion">
    <h1> Otros Productos </h1>

    <p> </p>

    <p class="animate"> Nosotros te la llevamos a tu casa </p>

    <p class="textproductos">
      Si te intereso alguna, dirigite a <a href="Pedidos-y-contactos.php"> PEDIDOS Y CONTACTOS </a>
    </p>
</section>

<section class="productos">

    <?php foreach($mostrarMarcasTipo as $mm){?>

        <article class="producto">
            <p class="marcaProducto"> <?php echo $mm['marca'];?> </p>

                <?php 
                $tipoMarca = $mm['marca'];
                $mostrarTiposDos = $objMostrarMarcas ->mostrarMarcasTipoDos($tipoMarca);
                foreach($mostrarTiposDos as $mmd){  
                    $precioVenta = $mmd['precioVenta'];
                    $idWl = $mmd['id'];
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

                <?php }?>

        </article>

    <?php }} ?>

</section>

<?php include 'template/footer.php'; ?>
</body>
</html>