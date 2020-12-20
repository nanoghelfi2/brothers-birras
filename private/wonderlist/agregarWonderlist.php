<!DOCTYPE html>
<?php   
require '../cuenta/compruebaVentas.php';
require '../clases/ProductosPag.php';	

$objMostrar = new Wonderlist();
$mostrarMarcas = $objMostrar ->mostrarMarcas();

?>
<html lang="en">
<head>
<meta name="googlebot" content="noindex">
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/negociosComp.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocios</title>
</head>
<body>

<?php if(!isset($_POST['selMarca']) & !isset($_POST['agrMarca']) & !isset($_GET['pagPP'])){ ?>
<p class="pasosCir">1</p>
<b> Seleccione una marca existente, o escriba una nueva marca. </b>
<div class="agregaMarca">
    <form action="agregarWonderlist.php" method="post">
        <label for="seleccionar"> Seleccione:</label>
            <select name="selMarca">
                <option> - </option>
            <?php foreach($mostrarMarcas as $mwm){ ?>
                <option> <?php echo $mwm['marca'];?> </option>         
            <?php } ?>
            </select> <br>

        <label for="seleccionar"> O escriba una nueva:</label>     
            <input type="text" name="escMarca"> <br>
        
        <center> <input type="submit" value="SIGUENTE"> </center>
    </form>
</div>
<?php }else if(isset($_POST['selMarca'])){   //ACA COMIENZA PARA DARLE EL RESTO DE DATOS
    $selMarca = $_POST['selMarca'];
    $escMarca = $_POST['escMarca'];
        $escMarca = trim($escMarca);


    if($selMarca !== '-' & $escMarca !== ''){
        header('location:agregarWonderlist.php');}
    if($selMarca == '-' & $escMarca == ''){
        header('location:agregarWonderlist.php');
    }else{
        if($selMarca == '-'){
            $agrMarca = $escMarca;
        }else{
            $agrMarca = $selMarca;}} 
?>


<p class="pasosCir">2</p>
<b> Ahora escriba el tipo del producto y el resto de informacion </b><br><br>
<b style="font-size: 120%;">Marca: <?php echo $agrMarca ?></b>


<div class="agregaMarca">
    <form action="agregarWonderlist.php" method="post">
        <label for="tipo"> Escriba un <b>TIPO</b>:</label>     
            <input type="text" name="tipo" style="margin-top:5%;" require>

        <label for="cantidad"> Cantidad <b>(STOCK)</b>:</label>     
            <input type="number" name="cantidad">

        <label for="costo"> Valor de <b>COSTO</b>: </label>     
            <input type="number" name="costo">

        <label for="valorUn"> Valor x <b>UNIDAD</b>: </label>     
            <input type="number" name="valorUn">

        <label for="valorPack"> Valor x <b>PACK</b>: </label>     
            <input type="number" name="valorPack">

        <label for="valorPack"> ¿Que <b>estilo</b> de birra es?: </label>     
            <select name="tipoCerveza">
                    <option> Artesanal </option>
                    <option> Industrial </option>
                    <option> Otros </option>
            </select>

        <input type="hidden" name="agrMarca" value="<?php echo $agrMarca; ?>">        
        <center> <input type="submit" value="AGREGAR PRODUCTO"> </center>
    </form>
</div>

<?php } //ACA TERMINA EL RESTO DE DATOS CERV 
if(isset($_POST['agrMarca']) & isset($_POST['tipo'])){

$marca = $_POST['agrMarca'];
$tipo = $_POST['tipo'];
$stock = $_POST['cantidad'];
$costo = $_POST['costo'];
$precioUn = $_POST['valorUn'];
$precioPack = $_POST['valorPack'];
$tipoCerveza = $_POST['tipoCerveza'];

$objAgregar = new Wonderlist();
$agregarProducto = $objAgregar ->agregarProducto($marca, $tipo, $costo, $precioUn, $precioPack, $stock, $tipoCerveza);

header('location:agregarWonderlist.php?marca='.$marca.'&tipo='.$tipo.'&pagPP=true'); }

if(isset($_GET['pagPP'])){
$marcaPP = $_GET['marca'];
$tipoPP = $_GET['tipo'];

$objAgregarPP = new Wonderlist();
$agregarPP = $objAgregarPP ->mostrarId($marcaPP, $tipoPP);

foreach($agregarPP as $app){
    $idWl = $app['id'];
    $titulo = $tipoPP; 


}

$objPP = new ProductosPag();
$agregarProducto = $objPP ->agregarProducto($idWl, $titulo);

header('location:verWonderlist.php?marca='.$marcaPP);

}



?>



    <a href="../panel.php" class="volverInicio"> <p>Volver al panel inicio</p> </a>
</body>
</html>