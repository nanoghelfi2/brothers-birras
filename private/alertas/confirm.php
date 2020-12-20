<?php /*Esto es una alerta que se va a utilizar para confirmar datos como el de si desea borrar
Vamos a necesitar varias $variables:
$texto = el texto que va a mostrar o pregunta para confirmar
$si = link de redireccion positiva
$no = link de redireccion negativa
*/ ?>

<div class="borrasionesAlerta">
    <p class="textoAlert"> <?php echo $texto; ?> </p>
        <a href="<?php echo $no;?>" class= "alertDenied"> NO </a>
        <?php echo $si; ?>
</div>