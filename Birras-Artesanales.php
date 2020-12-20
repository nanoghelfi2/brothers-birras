<?php
require 'private/clases/Conexion.php';
require 'private/clases/Wonderlist.php';		
require 'private/clases/ProductosPag.php';	
require 'php/verifEdad.php';	



$contador=0;
$objMostrarMarcas= new Wonderlist();
$objPpal= new ProductosPag();
$tipoCerveza = 'Artesanal';
$contadorCerveza =  $objMostrarMarcas ->contadorCervezas($tipoCerveza);
foreach($contadorCerveza as $cc){
    $contador = $contador+1;
}
?>
<!DOCTYPE html>
<style>.menuArtesanales{background-color: rgb(51, 49, 44); }</style>
<head>
    <link  rel="icon"   href="img/BrothersBirra.svg" type="image/png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/birrasArtesanales.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>Brothers Birras ➡- Cervezas Artesanales -</title>
    <meta name="description" content="✅Hey! te gustan las cervezas artesanales? A nosotros tambien. Entra aqui y mira todos los productos que tenemos. Ademas... hacemos delivery, TE LO LLEVAMOS HASTA TU CASA!">
</head>
<body>
<?php include 'template/header.php'; ?>

<section class="introduccion">
    <h1> Cervezas Artesanales </h1>

    <p> Sabemos que te aburriste de siempre los mismos sabores. ¿Te gustaria probar cosas nuevas?</p>

    <p class="animate"> <u>¡ANIMATE</u>! Nosotros te la llevamos a tu casa </p>

    <p class="textproductos">
        Deslizate hacia abajo y encontraras todas las variedades que tenemos para ofrecerte. <br>
        Y si te interesa alguna, dirigita a nuestra seccion de <a href="Pedidos-y-contactos"> PEDIDOS Y CONTACTOS </a> para comunicarte con nosotros.
    </p>
    <p class="textproductos">
        Hoy en dia contamos con la cantidad de <b><?php echo $contador ?></b> diferentes cervezas artesanales para que puedas elegir y siempre vamos sumando nuevas variedades!
    </p>
</section>

<div class="productos">
    <?php  //Traigo las Marca del wl segun su tipo (aca es artesanal)
    $mostrarMarcasTipo = $objMostrarMarcas ->mostrarMarcasTipo($tipoCerveza); 
    ?>
    <?php foreach($mostrarMarcasTipo as $mm){?>

        <section class="producto">
            <p class="marcaProducto"> <?php echo $mm['marca'];?> </p>

                <?php //traigo datos de cada producto segun su marca
                $tipoMarca = $mm['marca'];
                $mostrarTiposDos = $objMostrarMarcas ->mostrarMarcasTipoDos($tipoMarca);
                foreach($mostrarTiposDos as $i => $mmd){  
                    $precioVenta = $mmd['precioVenta'];
                    $idWl = $mmd['id'];
                    
                    //traigo la vista / informacion segundo el idTraido
                    $mostrarDatos = $objPpal ->mostrarPrincipal($idWl);
                    foreach($mostrarDatos as $md){
                    ?>

                    <article>
                        <?php if($md['imgMineatura'] !== ''){?>
                            <img src="<?php echo $md['imgMineatura'];?>" alt="">
                        <?php }else{echo 'default';} ?>

                        <div class="textosDetalles">
                            <div class="textosDet">
                                <p class="tipoProducto"> 
                                    <?php echo $md['titulo']; echo $md['aclaracion'] ?>: 
                                </p> 
                                <p class="precioProdcto">
                                    $ <?php echo $precioVenta;?>
                                </p>
                            </div>
        <div class="pAddCartMob">
 
                    Detalles haciendo <br>                                            
                    Click en leer mas.
        </div>
                            <a href="Cerveza-Artesanal/Birra?Num=<?php echo $idWl; ?>" class="masInfo">
                                <p>
                                LEER MAS 
                                </p>
                                <img src="img/flecha.png" alt="">
                            </a>
                        </div>
                    </article>
                <?php }} ?>
                </section>
    <?php }?>
</div>




<?php include 'template/footer.php'; ?>
</body>
</html>