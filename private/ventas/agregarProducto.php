<?php   
require '../cuenta/compruebaVentas.php';
require '../clases/Chango.php';
require '../clases/ProductosCh.php';

$objWonderlist = new Wonderlist();
$objChango = new Chango();
$objProductosCh = new ProductosCh();


## Obtengo la id del chango y traigo mas datos ##
if(isset($_POST['idChango'])){
$idChango = $_POST['idChango']; //VARIABLE ID DEL CHANGO
    if($idChango == ''){
        header('Location: nuevaVenta.php?error1=true');
    }}


$mostrarEstado = $objChango->mostrarEstado($idChango);
    foreach($mostrarEstado as $me){
$estado = $me['estadoVenta'];   //VARIABLE ESTADO DEL CHANGO
$idCliente = $me['nombreCliente']; //VARIABLE ID DEL CLIENTE
    }
###################################################



if(isset($_POST['paso'])){
$paso = $_POST['paso'];
}else{ $paso = 'uno';}

//COMPRUEBO LOS DATOS ENVIADOS EN EL PASO 1 -> PASO 2
if(isset($_POST['marca'])){
    $marca = $_POST['marca'];
    if($marca == '-' || $marca == ''){
        echo 'Debe elegir una marca';
        $paso = 'uno';
    }else{
        $paso = 'dos';
    }
}
//COMPRUEBO LOS DATOS ENVIADOS EN EL PASO 2 -> PASO 3
if($paso == 'tres'){
    if($_POST['tipoP2'] == '' || $_POST['tipoP2'] == '-'){
        echo 'Debe elegir un Tipo de cerveza';
        $marca = $_POST['marcaP2'];
        $paso = 'dos';
    }else{
        $marcaP2 = $_POST['marcaP2'];
        $tipoP2 = $_POST['tipoP2'];
    }
}
//COMPRUEBO LOS DATOS ENVIADOS EN EL PASO 3 -> PASO 4
if($paso == 'cuatro'){
    if($_POST['cantidadP3'] == '' || $_POST['cantidadP3'] == ' '){
        echo 'Debe elegir una cantidad';
        $marcaP2 = $_POST['marcaP3'];
        $tipoP2 = $_POST['tipoP3'];
        $paso = 'tres';
    }else{
        $PackUn = $_POST['packUn'];
        $cantidadCompra = $_POST['cantidadP3'];
        if($PackUn == 'Pack cerrado x 6'){
            $cC = $cantidadCompra * 6;
        }else{
            $cC = $cantidadCompra;
        }
            if($cC <= $_POST['cantidadActual'] & $cC > 0){
                $cantidadActual = $_POST['cantidadActual'];
                $marcaCerveza = $_POST['marcaP3'];
                $tipoCerveza = $_POST['tipoP3'];
                $cantidadReal = $cC;
            }else{
                echo 'La cantidad no debe ser mayor al stock';
                $marcaP2 = $_POST['marcaP3'];
                $tipoP2 = $_POST['tipoP3'];
                $paso = 'tres';
            }
    }
}
?>



<!DOCTYPE html>
<head>
    <meta name="googlebot" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/verVentas.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Nuevo Producto</title>
</head>
<body>

<center> 
<?php if($paso == 'uno'){ ?>
    <div class="paso">
        <p> PASO </p>
        <span>1</span>
    </div>
    <div class="lineas">
        <div class="linea linActiv"></div>
        <div class="linea"></div>
        <div class="linea"></div>
    </div>
    Seleccione una Marca:
    <form action="" method="post" class="formNombre">
        <input type="hidden" name="idChango" value="<?php echo $idChango; ?>">

        <select name="marca" require>
            <option value="">  -  </option>
        <?php 
        $mostrarMarcas = $objWonderlist ->mostrarMarcas(); 
        foreach($mostrarMarcas as $mm){  ?>
            <option> <?php echo $mm['marca']; ?>  </option>
        <?php } ?>
        </select>
        
        <input type="submit" value="SIGUENTE PASO">
    </form>

<?php } ?>

<?php       
if($paso == 'dos'){ ?>
    <div class="paso">
        <p> PASO </p>
        <span>2</span>
    </div>
    <div class="lineas">
        <div class="linea"></div>
        <div class="linea linActiv"></div>
        <div class="linea"></div>
    </div>
<?php  echo '<p><b> Marca: '.$marca.'</b></p>'; ?>

Seleccione un Tipo:
    <form action="" method="post" class="formNombre">
        <input type="hidden" name="paso" value="tres">
        <input type="hidden" name="idChango" value="<?php echo $idChango; ?>">
        <input type="hidden" name="marcaP2" value="<?php echo $marca; ?>">
        
        <select name="tipoP2" require>
                <option value=""> - </option>
            <?php 
            $mostrarTipos = $objWonderlist->mostrarTipos($marca);
            foreach($mostrarTipos as $mt){  ?>
                <option> <?php echo $mt['tipo']; ?>  </option>
            <?php } ?>
        </select>
        
        <input type="submit" value="SIGUIENTE PASO">
    </form>
<?php } ?>



<?php 
// Antes del paso tres, tengo que comprobar que el la cantidad no sea mas que el stock
if($paso == 'tres'){  ?>

    <div class="paso">
        <p> PASO </p>
        <span>3</span>
    </div>
    <div class="lineas">
        <div class="linea"></div>
        <div class="linea"></div>
        <div class="linea linActiv"></div>
    </div>

<?php  echo '<p><b> Marca: '.$marcaP2.'</b></p>'; ?>
<?php  echo '<p><b> Tipo: '.$tipoP2.'</b></p>'; 
            $mostrarStock = $objWonderlist ->mostrarStock($marcaP2, $tipoP2);   
            foreach($mostrarStock as $msp){
                $cantAct = $msp['stock']; }  ?>

<p id="stockActual"> Stock actual: <?php echo $cantAct.' '; ?> Un. </p>

<p id="informativo"><i> Debe elegir una cantidad que sea <b>menor</b> al stock actual indicado arriba </i></p>
<form action="" method="post" class="formNombre">
    <input type="hidden" name="paso" value="cuatro">
    <input type="hidden" name="idChango" value="<?php echo $idChango; ?>">
    <input type="hidden" name="marcaP3" value="<?php echo $marcaP2; ?>">
    <input type="hidden" name="tipoP3" value="<?php echo $tipoP2; ?>">
    <input type="hidden" name="cantidadActual" value="<?php echo $cantAct; ?>">

    Elija unidad o Pack:
    <select name="packUn"> 
            <option>Unidades</option>
            <option>Pack cerrado x 6</option>
    </select>  
    Cantidad: <input type="number" name="cantidadP3" require> 
    
    <input type="submit" value="AGREGAR">
</form>

<?php //Cierre del if paso == ?
}
?>

</center>

<?php 
if($paso == 'cuatro'){

        // ACA PIDO EL PRECIO CORRESPONDIENTE 
        if($PackUn == 'Pack cerrado x 6'){
            $mostrarPrecioPack = $objWonderlist ->mostrarPrecioPack($marcaCerveza, $tipoCerveza); 
            
            foreach($mostrarPrecioPack as $mpp){
            $precioPack = $mpp['precioPack']; }
            $unidad = 'Pack x6';
            $precioUnitario = $precioPack;
        }else{
            $mostrarPrecioUnitario = $objWonderlist ->mostrarPrecioUnitario($marcaCerveza, $tipoCerveza); 
    
            foreach($mostrarPrecioUnitario as $mp){
            $precioUnitario = $mp['precioVenta']; }           
            $unidad = 'Un';
        }

        $valor = $cantidadCompra * $precioUnitario;
        $valor = round($valor, 2);

        //Controlo en que estado esta el chango, si esta Pendiente, se tiene que quitar stock
        if($estado == 'pendiente'){
            $marcaWL = $marcaCerveza;
            $tipoWL = $tipoCerveza;
            $stockQuitar = $cantidadReal;
 
            $cantidadResultado = $cantidadActual - $stockQuitar;      

            //Esto cambia el stock del producto a quitar del chango
            $cambioStock = $objWonderlist ->cambioStock($marcaWL, $tipoWL, $cantidadResultado); 
        }

        echo '<br><p style="font-weight: bold;"> Se agrega el siguiente producto: </p>';
        echo 'Marca:  '.$marcaCerveza;
        echo '<br> Tipo:  '. $tipoCerveza;
        echo '<br> Valor:  '. $valor;
        echo '<br> Estado:  '. $estado;

        $agregarProducto = $objProductosCh ->agregarProducto($idChango, $marcaCerveza, $tipoCerveza, $cantidadCompra, $unidad, $valor);    

       header('Location: chango.php?changoNumero='.$idChango);
        
   




} ?>

    <a href="chango.php?changoNumero=<?php echo $idChango; ?>" class="volverInicio" style="bottom:60px;background-color: mediumspringgreen;"> <p>Volver al Chango</p> </a>
    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
</body>
</html> 