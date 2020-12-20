<?php   
require '../clases/Chango.php';
require '../clases/Cliente.php';
require '../cuenta/compruebaVentas.php';	

if(isset($_GET['id'])){
$idVenta = $_GET['id'];}

$objChangos = new Chango();
$objCliente = new Cliente();

$changosEnProceso = $objChangos ->changosEnProceso(); 

if(isset($_GET['error1'])){?>
    <div class="alertError"> Agregue un nombre al chango </div>
<?php }
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta name="googlebot" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/verVentas.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/panel.css">
    <title>Subir precios</title>
</head>
<body>
<a href="../panel.php" class="botonAtras"> <img src="../img/flecha.svg" alt=""> Atras </a>
    <div class="agregarChangoMasDiv">
        <a href="datosCliente.php" class="agregarChangoMas">
            <div class="menuDiv">
                <p class="text4div"> + </p>
                <p class="text2div"> Empezar </p>
            </div>
        </a>
    </div>


    <div style="border-top: 1px solid black; margin-top:5%;">
        <center><p>Ventas en proceso</p></center>
        <?php foreach($changosEnProceso as $cep){  ?>
            <div class="changoAB">
                <?php 
                $idCliente = $cep['nombreCliente'];
                $onlyName = $objCliente -> onlyName($idCliente);
                foreach($onlyName as $on){
                ?>
                <a href="chango.php?changoNumero=<?php echo $cep['id'];  ?>" class="changoA">
                      <p>Cliente:<b><?php echo ' '.$on['nombreCliente']; ?></b> </p>
                </a>
                <?php } ?>
                <a href="changoManejo.php?nombreChango=<?php echo $cep['id'];?>&bolean=no" class="changoB">
                     <p> X </p>
                </a>
            </div>
        <?php } ?>
    </div>

        
    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
</body>
</html>