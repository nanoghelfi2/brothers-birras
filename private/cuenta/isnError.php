<?php  ?>
<!DOCTYPE html>
<html>
<head>
<meta name="googlebot" content="noindex">
	<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="pdcn.css">
<link rel="stylesheet" type="text/css" href="../css/estilos.css">
<title>Inicial secion</title>
</head>
<body>

<div class="centrado">
		<form action="vsn.php" method="post" class="formContainer">
			
				<div><label>	Usuario: <input type="text" name="usuario" >  </label></div>
				<div><label>	Contraseña: <input type="password" name="contraseña"></label></div>
				
				<input type="submit" value="Iniciar secion" class="submitForm">

				<p style="color: red;"> Nombre de usuario o contraseña incorrecta </p> 
			
		</form>
	</div>


</body>
</html>