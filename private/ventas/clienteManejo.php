<?php  
require '../cuenta/compruebaVentas.php';
require '../clases/Chango.php';	
require '../clases/Cliente.php';

$objChango= new Chango();
$objCliente= new Cliente();





?>
<head>
<meta name="googlebot" content="noindex">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/verVentas.css">
<link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<?php

//ESTO BORRA UN CLIENTE
if(isset($_GET['nombreClienteBorrar'])){
    $nombreClienteBorrar = $_GET['nombreClienteBorrar'];
    $compruebaChango = $objChango ->mostrarPorCliente($nombreClienteBorrar);
    $cantidad = 0;
    #compruebo que no haya chango activo con este cliente
    foreach($compruebaChango as $cc){
        $cantidad = $cantidad + 1;
    }
    if($cantidad > 0){
        echo 'No se puede eliminar este cliente, ya que hay uno o mas changos creados para este cliente.<br> <a href="datosCliente.php"> <b> VOLVER </b></a>';
        die();
    }#si lo hay, finaliza la operacion con ese mensaje
    if($_GET['bolean'] == 'no'){
    ?>
        <div class="borrasionesAlerta">
            <p> ¿Estas seguro que quiere borrar el cliente "<?php echo $nombreClienteBorrar; ?>"? </p>

            <a href="datosCliente.php">
                        NO, volver </a>

            <a href="clienteManejo.php?nombreClienteBorrar=<?php echo $nombreClienteBorrar;?>&bolean=si"> 
                        SI, borrar </a>
        </div>
    <?php  die();
    }else{
            echo $nombreClienteBorrar;
          $borrarCliente = $objCliente ->borrarCliente($nombreClienteBorrar); 
          header("location:datosCliente.php");} 
}


//GUARDA NUEVO CLIENTE
if(isset($_POST['guardarNuevoCliente'])){
    if($_POST['guardarNuevoCliente'] == 'true'){
    
    $nombreC = $_POST['nombreCliente'];
    $contactoU = $_POST['contactoUno'];
    $lug = $_POST['lugar'];
    
    if($nombreC == '' || $contactoU == '' || $lug == ''){
        header('Location: datosCliente.php?error=');  
    }else{
        $nombreCliente = $nombreC;
        $contactoUno = $contactoU;
        $lugar = $lug;
        $contactoDos = $_POST['contactoDos'];
        $lugarDos = $_POST['lugarDos'];
    
    $agregarCliente = $objCliente ->agregarCliente($nombreCliente, $contactoUno, $contactoDos, $lugar, $lugarDos);   
    }
    
    }}
    

####################################################################################
#ESTO COMPRUEBA EL ID DEL CHANGUITO, PERO NO INFLUYE EN EL BORRAR DE UN CLIENTE 
if(isset($_POST['idChango'])){
$idChango = $_POST['idChango']; //VARIABLE ID DE CHANGO 
        }else{ ?>
        <a href="../panel.php" class="volverInicio"> 
            <p>Volver al panel inicio</p> 
        </a> 
        <?php die('No se encontro id del chango, no se puede continuar. Comuncarse con Luciano');}
    
    $mostrarEstado = $objChango->mostrarEstado($idChango);
        foreach($mostrarEstado as $me){
$estado = $me['estadoVenta'];   //VARIABLE ESTADO DEL CHANGO
$idCliente = $me['nombreCliente']; //VARIABLE ID DEL CLIENTE
}
####################################################################################



//AGREGA LUGAR TEMPORAL
if(isset($_POST['lugarTemporal'])){
    $lugarTemporal = $_POST['lugarTemporal'];
    $lugarTemporal = trim($lugarTemporal);

    $editarLugarTemporal = $objCliente ->editarLugarTemporal($idCliente, $lugarTemporal);           

    header("location:chango.php?changoNumero=".$idChango);
}

//CAMBIAR EL CLIENTE DEL CHANGO

if(isset($_POST['cambiarElCliente'])){
if(is_numeric($_POST['cliente'])){
    $idChango = $_POST['idChango'];
    $idCliente = $_POST['cliente'];

    $cambiarCliente = $objChango -> cambiarCliente($idChango, $idCliente);
    header("Location: chango.php?changoNumero=".$_POST['idChango']);  
}else{
    header("Location: chango.php?changoNumero=".$_POST['idChango']);  
}}


?>