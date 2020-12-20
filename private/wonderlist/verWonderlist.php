<?php   
require '../cuenta/compruebaVentas.php';		



if(!isset($_GET['marca'])){
$marca = 'todas';
}else{
    $marca = $_GET['marca'];
}




$objMarca = new Wonderlist();
$mostrarMarcas = $objMarca ->mostrarMarcas(); 
$objWonderlist = new Wonderlist();
$mostrarWonderlist = $objWonderlist ->mostrarWonderlist(); 
$objWonderlistMarca = new Wonderlist();
$mostrarWonderlistxMarca = $objWonderlistMarca ->mostrarWonderlistxMarca($marca); 

?>

<!DOCTYPE html>
<head>
    <meta name="googlebot" content="noindex">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/negociosComp.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocios</title>
</head>
<body>
<a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
<div class="containerTodo">
<a href="../panel.php" class="botonAtras"> <img src="../img/flecha.svg" alt=""> Atras </a> 
 
<a href="agregarWonderlist.php" class="agregarProd"> 
    <p id="mas">+</p>
    <p id="text">Agregar Producto</p>
</a>

    <div class="containerDos">
        <p> Seleccione Marca: </p>
        <form action="verWonderlist.php" method="get">
            <select name="marca">
                    <option> todas </option> 
                <?php foreach($mostrarMarcas as $mm){ ?>
                    <option> <?php echo $mm['marca']; ?> </option>
                <?php } ?>
            </select>  
            <input type="submit" value="BUSCAR" id="enviarSubmit">
        </form>
    </div>



<?php if($marca == 'todas'){ ?>
    <br>
    <table id="listadoC">
    <tr>
        <th> MARCA </th>
        <th> TIPO </th>
        <th> $ Costo </th>
        <th>  Unidad <br>
             Y PACKx6 </th>
        <th> STOCK </th>
    </tr>
    <?php foreach($mostrarWonderlist as $mwl){ ?>
    <tr>
        <td> <?php echo $mwl['marca'];        ?>     </td>
        <td> <?php echo $mwl['tipo'];         ?>     </td>
        <td>$ <?php echo $mwl['precioCompra']; ?>     </td>
        <td>$ <?php echo $mwl['precioVenta'];  ?>     <br>
        $ <?php echo $mwl['precioPack'];  ?>     </td>
        <td> <?php echo $mwl['stock'];        ?>    </td>
    </tr>
    <?php } ?>
    </table>

<?php }else{?> 
    <p class="negrita" style="align-self: flex-start; font-size: 120%; margin:2% 0 2% 0;">  
        Marca = <?php echo $marca;   ?> 
    </p>    

<form action="editarWonderlist.php" method="post">
    <table id="listadoC">
    <tr>
        <th> TIPO </th>
        <th> $ Costo </th>
        <th> $ Unid. </th>
        <th> $ PACKx6 </th>
        <th> STOCK </th>
    </tr>
    <?php foreach($mostrarWonderlistxMarca as $mwlm){ ?>
    <tr>
        <td> <?php echo $mwlm['tipo'];         ?>     </td> 
        <td>$ <?php echo $mwlm['precioCompra']; ?>     </td>
        <td>$ <?php echo $mwlm['precioVenta'];  ?>     </td>
        <td>$ <?php echo $mwlm['precioPack'];  ?>     </td>
        <td> <?php echo $mwlm['stock'];        ?>     </td>
        <td style="width: 10%;"><input type="radio" name="producto" value="<?php echo $mwlm['id']; ?>"></td>
    </tr>
    <?php } ?>
    </table>
    <input type="hidden" name="marca" value="<?php echo $marca; ?>">
    <input type="submit" value="REALIZAR CAMBIOS" class="botomEnviar">
</form>

    <?php } ?>
</div>

</body>
</html>

