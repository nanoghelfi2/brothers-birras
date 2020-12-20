<!DOCTYPE html>
<?php 
require 'php/verifEdad.php';	

?>
<html lang="en">
<style>.menuPromos{background-color: rgb(51, 49, 44); }</style>
<head>
    <link  rel="icon"   href="img/BrothersBirra.svg" type="image/png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/birrasArtesanales.css">
    <link rel="stylesheet" type="text/css" href="css/promos.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>PROMOS</title>
</head>
<body>
<?php include 'template/header.php'; ?>

<section class="introduccion">
    <h1> Promos </h1>

    <p> Las mejores y divertidas ofertas </p>

    <p class="animate"> Nosotros te la llevamos a tu casa </p>

    <p class="textproductos"> Si aun no te terminas de decidir que llevarte, te ofrecemos estas promos para que elijas el que mas se adapte a vos y puedas disfrutar de eso que tanto te gusta.
    Y, si te interesa algun combo, dirigite a <a href="Pedidos-y-contactos.php"> PEDIDOS Y CONTACTOS </a> y para enterarte de sorteos, <a href="">SEGUINOS</a> en nuestras redes.
    </p>
</section>

<article class="promos tupack" style="background-color: rgba(161, 139, 89, 0.13);">
    <h2> Combo: BROTHERS BIRRAS  </h2>
    <div class="textoCombo">
        <p id="descuentoT">
            <span>10%</span> 
            <br> 
            DESCUENTO
        </p>
        <p id="descripcionT">
            Llevando a partir de 6 unidades de CERVEZAS ARTESANALES a ELECCION
        </p>
    </div>
</article> 


<article class="promos">
    <h2> Combo Fernet Branca + Coca-Cola</h2>
    <p class="comboNormWidth"> Fernet Branca de (750 ml) </p>
    <p> + 2 Coca-colas (2.25 L) </p> 
    <p style="font-weight: bold;"> $ 720 </p>
</article>

<article class="promos" style="margin-bottom:0%">
    <h2> Combo Gancia + Sprite </h2>
    <p class="comboNormWidth"> Gancia (950 ml) </p>
    <p> + 1 Sprite (2.25 L) </p> 
    <p style="font-weight: bold;"> $ 400 </p>
</article>
<?php include 'template/footer.php'; ?>
</body>
</html>