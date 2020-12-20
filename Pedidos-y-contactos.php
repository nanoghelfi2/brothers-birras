<!DOCTYPE html>
<?php 
require 'php/verifEdad.php';	

# %0A  = SALTO DE LINEA

$texto = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. %0A Sed, cupiditate natus numquam vero aliquid adipisci at fuga quaerat libero necessitatibus odit totam unde, facilis cumque voluptates beatae, sint ratione corrupti?';


?>
<html lang="en">
<style>.menuContacto{background-color: rgb(51, 49, 44); }</style>
<head>
    <link  rel="icon"   href="img/BrothersBirra.svg" type="image/png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/contactos.css">
    <link rel="stylesheet" type="text/css" href="css/birrasArtesanales.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>CONTACTO</title>
</head>
<body>
<?php include 'template/header.php'; ?>

<section class="introduccion">
    <h1> Pedidos y contactos </h1>

    <p> Brothers Birras, mejoramos dia a dia. </p>
    <p class="animate"> Nosotros te la llevamos a tu casa </p>

    <p class="textproductos"> 
        Hacenos tu pedido, o aclara tus dudas mandando un Whatsapp a: 
    </p>
    <img src="img/logoWpp.png" class="logoWpp">  
    <p id="whatsapp">
          +54 11 6148-2079 <a href="https://api.whatsapp.com/send?phone=5491161482079&text=<?php echo $texto; ?>&source=&data=&app_absent=" class="chat">Ir al chat</a> 
    </p>
          <br> <br>
    <p id="whatsapp">
          +54 11 6046-7934 <a href="https://api.whatsapp.com/send?phone=541160467934&text=&source=&data=&app_absent=" class="chat">Ir al chat</a>
    </p>
    
    <p class="textproductos"> 
        Datos de los ENVIOS a tener en cuenta:
    </p>
    <p class="textproductos2">
        Los envios en la zona de Tigre, se realizan en cuanto vos necesites. Zonas mas alejadas, se realizara el envio a partir de las 16:00 hs
    </p>
    
</section>


<?php include 'template/footer.php'; ?>
</body>
</html>