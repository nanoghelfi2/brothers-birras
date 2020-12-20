<!DOCTYPE html>
<?php
#header('Content-Type: application/json');
$sHTML = '';
$msjWpp = 'Hola, quiero hacer pedido de estos productos: %0A';
$fPrecioTotal = 0;


/* $msjWppPrueba = 'Hola, quiero hacer pedido de estos productos: %0A 
            -Peñon del aguila, Sandia ($160) cantidad: 3 ($480) %0A 
            -Peñon del aguila, Sandia ($160) cantidad: 3 ($480) %0A 
            -Peñon del aguila, Sandia ($160) cantidad: 3 ($480) %0A 
            -Peñon del aguila, Sandia ($160) cantidad: 3 ($480) %0A 
            -Peñon del aguila, Sandia ($160) cantidad: 3 ($480) %0A 
            TOTAL: $2880'; */



?>


<head>
    <link  rel="icon"   href="img/BrothersBirra.svg" type="image/png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/carrito.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>Brothers Birras ⬅| Carrito </title>
    <meta name="description" content="✅Hace el pedido de todos los productos que desees">
</head>
<body>
<?php include 'template/header.php'; ?>

<h1> Bienvenido a tu carrito de compras</h1>
<p id="textPrin">  No necesitas logearte, al hacer click en <b> HACER EL PEDIDO </b>, seras redirigido a <b>Whatsapp</b> junto a la lista de productos que elegiste! </p>

<section class="listadoCarrito">
<?php
if(isset($_COOKIE['carrito'])) {
    #$aCarrito = unserialize($_COOKIE['carrito']);
    $aCarrito = json_decode($_COOKIE['carrito'], true);

foreach ($aCarrito as $key => $value) {
    $precioSuma = $value['precio'] * $value['cantidad'];
    $msjWpp .= ' -'.$value['marca'].', '.$value['tipo'].'($'.$value['precio'].') /cantidad: '.$value['cantidad'].'('.$value['unidad'].')'.' ($'.$precioSuma.') %0A';
    $fPrecioTotal += $precioSuma; ?>

    <article class="producto">

        <div class="productoMarca">
            <p id="marca"><b> <?php echo $value['marca'];  ?> </b></p>
            <p>    <?php echo $value['tipo'];  ?> </p>
            <p> <b> $ <?php echo $value['precio'];  ?></b> </p>
        </div>

        <div class="productoCant">
            <p>   Cantidad:  </p>
            <span> <?php echo $value['cantidad'];  ?> (<?php echo $value['unidad'];  ?>)
            </span> 
        </div>

        <div class="productoTotal">
           <p id="precio">   $ <?php echo $precioSuma; ?> </p>
            
        </div>
        <a href="aprobarProducto.php?borrarProducto=<?php echo $key; ?>"> Eliminar </a>
    </article>

    
<?php  
}}
?>
   <div id="precioTotal"> <p> Total: $<?php echo $fPrecioTotal;  ?> </p> </div>

    

<?php  
$msjWpp .= 'Total: '. $fPrecioTotal;
?>

<div class="botonesCarrito"> 

    <a href="aprobarProducto.php?vaciar=true" id="vaciar"> Vaciar carrito </a>

    <?php if($fPrecioTotal == '$0'){ ?>
        <div id="fin" style="background-color: rgb(2, 48, 78); color:grey;"> Hacer el pedido </div>
    <?php }else{ ?>
    <a href="https://api.whatsapp.com/send?phone=5491161482079&text=<?php echo $msjWpp; ?>&source=&data=&app_absent=" id="fin"> Hacer el pedido </a>
<?php } ?>

</div>
</section>
<div class="explicacion">
<h2> ¿Como funciona el carrito? </h2>
 <p>El funcionamiento del carrito de compras de esta web es muy sensillo, te lo explicamos por pasos:</p> <br><br>
    <p>
    <b> 1) </b> Tu eliges los productos que te gustaria comprar. <br>
    <b> 2) </b> Estos se van almacenando en el carrito que esta arriba. <br>
    <b> 3) </b> Una vez que ya tengas todos los productos que desees, haz click en el boton que dice <b>"Hacer el pedido"</b> <br>
    <b> 4) </b> Este boton te redireccionara a la pagina de whatsapp, alli le haces click en "Continuar al chat" y te enviara hacia whatsapp en una conversacion con nosotros con los productos elegidos. <br>
    <b> 5) ¡Te esperamos alli para continuar con la compra! </b>
    </p>


</div>





<?php include 'template/footer.php'; ?>
</body>
</html>