<?php   
require '../clases/Ventas.php';	
require '../cuenta/compruebaVentas.php';

if(isset($_GET['id'])){
$idVenta2 = $_GET['id'];
    if(substr_count($idVenta2, "'")> 0){    
        echo 'no te hagas el vivo PA'; die();
        }else{
            $idVenta = $idVenta2;
        }
}

$objVerVentas = new Ventas();
$verVentas = $objVerVentas ->verVentas(); 
$objVerVentasXid = new Ventas();
$verVentasXid = $objVerVentasXid ->verVentasXid($idVenta); 
// ' OR nombreCliente = 'Boqui
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="googlebot" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/verVentas.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Subir precios</title>
</head>
<body>

    <?php 
        if($idVenta == ''){ 
        ?>
        <div class="ventasDiv ventasHoy">
            <p class="ventasDia"> Ventas hoy: </p>
            <?php 
            $fechaActual = date('Y-m-d');
            $fechaAyer = date('Y-m-d', strtotime($fechaActual. "- 1 days"));
            $objVentasAyer = new Ventas();
            $verVentasAyer = $objVentasAyer ->verVentasAyer($fechaAyer); 
            $verVentasHoy = $objVentasAyer ->verVentasAyer($fechaActual);
            
            foreach($verVentasHoy as $vv){ ?>
            <a href="verVentas.php?id=<?php echo $vv['id'];?>">
                <div class="ventas" style="background-color: rgb(0, 180, 105);"> 
                    <div>
                        <p class="titulo"> Lugar: </p>
                        <p><?php echo $vv['lugar'];?></p>
                    </div>
                    <div>
                        <p class="titulo">Cliente: </p>
                        <p> <?php echo $vv['nombreCliente']; ?></p>
                    </div>
                    <div>
                        <p class="titulo">Fecha: </p>
                        <p><?php $fechaActu = $vv['fecha']; 
                                                
                                  echo $fechaActu;                  ?></p>
                    </div>
                </div>
            </a>
           <?php } ?>
           </div>

           <div class="ventasDiv ventasAyer">
            <p class="ventasDia"> Ventas ayer: </p>
           <?php foreach($verVentasAyer as $vv){ ?>
            <a href="verVentas.php?id=<?php echo $vv['id'];?>">
                <div class="ventas" style="background-color:rgb(29, 173, 230);"> 
                    <div>
                        <p class="titulo"> Lugar: </p>
                        <p><?php echo $vv['lugar'];?></p>
                    </div>
                    <div>
                        <p class="titulo">Cliente: </p>
                        <p> <?php echo $vv['nombreCliente']; ?></p>
                    </div>
                    <div>
                        <p class="titulo">Fecha: </p>
                        <p><?php $fechaActu = $vv['fecha']; 
                                                
                                  echo $fechaActu;                  ?></p>
                    </div>
                </div>
            </a>
           <?php } ?>
           </div>

           <div class="ventasDiv ventasResto">
                <p class="ventasDia"> Resto de ventas: </p>
           <?php 
            $verVentasResto = $objVentasAyer ->verVentasResto($fechaAyer); 
            foreach($verVentasResto as $vv){ ?>
            <a href="verVentas.php?id=<?php echo $vv['id'];?>">
                <div class="ventas" style="background-color: rgb(15, 138, 175);"> 
                    <div>
                        <p class="titulo"> Lugar: </p>
                        <p><?php echo $vv['lugar'];?></p>
                    </div>
                    <div>
                        <p class="titulo">Cliente: </p>
                        <p> <?php echo $vv['nombreCliente']; ?></p>
                    </div>
                    <div>
                        <p class="titulo">Fecha: </p>
                        <p><?php $fechaActu = $vv['fecha']; 
                                                
                                  echo $fechaActu;                  ?></p>
                    </div>
                </div>
            </a>
           <?php } ?>
           </div>




            <?php //VENTA SEGUN ID
            }else{ foreach($verVentasXid as $vvxid){   ?>
                
                        <p class="negrita"> Lugar: </p>
                        <p><?php echo $vvxid['lugar'];?></p>

                        <p class="negrita">Nombre del cliente: 
                        <p><?php echo $vvxid['nombreCliente']; ?></p>

                        <p class="negrita">Fecha:</p>
                        <p><?php echo $vvxid['fecha']; ?></p>

                        <p class="negrita">Valor total: 
                        <p>$ <?php echo $vvxid['valorVenta']; ?></p>

                        <p class="negrita">Productos: </p>
                        <p><?php echo $vvxid['productosVendidos']; ?></p>
            <?php } }  ?>


          <!--  <br> <br><br> <br><br> <br><br> <br><br> <br>
            VER VENTAS SEGUN: 
            <?php 
            $objVentasSegun = new Ventas();
            $verVentasSegun = $objVentasSegun ->verVentasSegun('Barba');   
            ?>
            <?php foreach($verVentasSegun as $vv2){ ?>
            <a href="verVentas.php?id=<?php echo $vv2['id'];?>">
                <div class="ventas" style="background-color:rgb(29, 173, 230);"> 
                    <div>
                        <p class="titulo"> Lugar: </p>
                        <p><?php echo $vv2['lugar'];?></p>
                    </div>
                    <div>
                        <p class="titulo">Cliente: </p>
                        <p> <?php echo $vv2['nombreCliente']; ?></p>
                    </div>
                    <div>
                        <p class="titulo">Fecha: </p>
                        <p><?php $fechaActu = $vv2['fecha']; 
                                                
                                  echo $fechaActu;                  ?></p>
                    </div>
                </div>
            </a>
           <?php } ?>
           <br> <br><br> <br><br> <br><br> <br><br> <br> -->


    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
</body>
</html>