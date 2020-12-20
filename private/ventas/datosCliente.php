<?php   
require '../cuenta/compruebaVentas.php';
require '../clases/Ventas.php';	
require '../clases/Chango.php';	
require '../clases/Cliente.php';	

$objMostrarClientes = new Cliente();
$mostrarNombresClientes = $objMostrarClientes ->mostrarNombresClientes();   


?>

<!DOCTYPE html>
<head>
<meta name="googlebot" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/verVentas.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Datos de cliente</title>
</head>
<body>

<a href="nuevaVenta.php" class="botonAtras"> <img src="../img/flecha.svg" alt=""> Atras </a>

   <center> <h2> Datos de clientes</h2> </center>

<div class="datosBBDD">
   <form action="chango.php" method="get" class="formCliente"> 
                <h4> Buscar cliente en base de datos. </h4> 
<center>    Nombre: <select name="newChangoClient" require>
                        <option> - </option>
                    <?php foreach($mostrarNombresClientes as $mnc){?>
                        <option value="<?php echo $mnc['idcliente']; ?>"> 
                            <?php echo $mnc['nombreCliente']; ?> 
                        </option>
                    <?php } ?>
                    </select> <br>
        <input type="submit" value="Crear chango" class="enviarCliente">     </center>
   </form>    

</div>
    
<div class="nuevoCliente">

<?php
if(isset($_GET['error'])){ ?>
        <div class="alertError"> 
               RELLENAR LOS CAMPOS obliatorios marcados con (*)
        </div>
<?php } ?>

    <form action="clienteManejo.php" method="post" class="formNuevoCliente">
                <h4>Nuevos cliente:</h4>
        <p> *Nombre cliente: </p>   
            <input type="text" name="nombreCliente" require/>
        <p> *Contacto 1: </p>
            <input type="text" name="contactoUno" require/>
        <p> Contacto 2:(opcional) </p>
            <input type="text" name="contactoDos">
        <p> *Lugar: </p>
            <input type="text" name="lugar" require/>
        <p> Lugar 2:(opcional) </p>
            <input type="text" name="lugarDos">
        <input type="hidden" name="guardarNuevoCliente" value="true">
        <input type="submit" value="Guardar y crear chango" class="enviarCliente">
    </form>

</div>

<div class="datosBBDD">
   <form action="clienteManejo.php" method="get" class="formCliente"> 
                <h4> Borrar cliente. </h4> 
<center>    Nombre: <select name="nombreClienteBorrar">
                         <option> - </option>
                    <?php foreach($mostrarNombresClientes as $mnc){?>
                         <option value="<?php echo $mnc['idcliente']; ?>"> <?php echo $mnc['nombreCliente']; ?>  </option>
                    <?php } ?>
                    </select> <br>
                    <input type="hidden" name="bolean" value="no">
        <input type="submit" value="Borrar" class="enviarCliente">     </center>
   </form>    
</div>

<div class="datosBBDD">
    <form action="datosCliente.php" method="get" class="formCliente"> 
                    <h4> Ver datos de cliente. </h4> 
    <center>    Nombre: <select name="id">
                         <option> - </option>
                        <?php foreach($mostrarNombresClientes as $mnc){?>
                            <option value="<?php echo $mnc['idcliente']; ?>"> <?php echo $mnc['nombreCliente']; ?>  </option>
                        <?php } ?>
                        </select>
                         <br>

            <input type="submit" value="VER" class="enviarCliente">     </center>
    </form>  
</div>
<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $objMostrarDatos = new Cliente();
        $mostrarDatosCliente = $objMostrarDatos ->mostrarDatosCliente($id);
        
        foreach($mostrarDatosCliente as $mdc){ ?>
        <p class="negrita">    Nombre Cliente:  <?php echo $mdc['nombreCliente']; ?>  </p> 
        <p class="negrita">    Contacto 1:      <?php echo $mdc['contacto'];      ?>  </p>
        <p class="negrita">    Contacto 2:      <?php echo $mdc['contactoDos'];   ?>  </p>
        <p class="negrita">    Lugar 1:         <?php echo $mdc['lugar'];         ?>  </p>
        <p class="negrita">    Lugar 2:         <?php echo $mdc['lugarDos'];      ?>  </p>
    <?php   
    }}
?>
<br><br><br>

    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
</body>
</html>