<link rel="stylesheet" type="text/css" href="css/header.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

<header>

<section class="logo">
      <a href="index">  <img src="img/BrothersBirra.svg" alt=""> </a>
</section>

<?php 

$cantidadProductos = 0;
if(isset($_COOKIE['carrito'])) {
$aCarrito = json_decode($_COOKIE['carrito'], true);

foreach ($aCarrito as $key => $value) {
$cantidadProductos = $cantidadProductos + $value['cantidad'];
}} 

?>

<a href="Carrito.php" class="carritoContainer">
        <img src="img/carritov2.svg" alt="">
        <p> Carrito (<?php  echo $cantidadProductos; ?>) </p>
</a>

<nav class="menuPc">

    <article style="font-weight: bold;"> 
            <a href="Birras-Artesanales" class="menuArtesanales"> BIRRAS ARTESANALES </a>
    </article>

    <article> 
            <a href="Birras-Tradicionales" class="menuTradicionales"> BIRRAS TRADICIONALES </a>
    </article>

    <article> 
           <a href="Otros" class="menuOtros"> OTROS PRODUCTOS </a>
    </article>

    <article> 
           <a href="Promos" class="menuPromos"> PROMOS </a>
    </article>

    <article> 
            <a href="Pedidos-y-contactos" class="menuContacto"> PEDIDOS Y CONTACTOS </a>
    </article>
    
    <article style="font-weight: bold;"> 
            <a href="Redes" class="redes"> SEGUINOS </a>
    </article>

</nav>

<nav class="menu700">
        <section class="menu1">
                <article style="font-weight: bold;"> 
                        <a href="Birras-Artesanales" class="menuArtesanales"> BIRRAS ARTESANALES </a>
                </article>

                <article> 
                        <a href="Birras-Tradicionales" class="menuTradicionales"> BIRRAS TRADICIONALES </a>
                </article>

                <article> 
                        <a href="Otros" class="menuOtros"> OTROS PRODUCTOS </a>
                </article>
        </section>       
        <section class="menu2">
                <article> 
                        <a href="Promos" class="menuPromos"> PROMOS </a>
                </article>

                <article> 
                        <a href="Pedidos-y-contactos" class="menuContacto"> PEDIDOS Y CONTACTOS </a>
                </article>
                
                <article style="font-weight: bold;"> 
                        <a href="Redes" class="redes"> SEGUINOS </a>
                </article>
        </section>
</nav>

</header>  
