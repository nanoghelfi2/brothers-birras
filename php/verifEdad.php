<?php
session_name('verifEdad');
session_start();

if(isset($_POST['verificador'])){
    if($_POST['verificador'] == 'si'){
        $_SESSION['mayorEdad'] = true; 
    }elseif($_POST['verificador'] == 'no'){
        header("Location: https://www.google.com/search?q=porque+no+tomar+alcohol+antes+de+los+18&oq=porque+no+tomar+alcohol+antes+de+los+18&aqs=chrome..69i57j0.9895j0j4&sourceid=chrome&ie=UTF-8"); 
    }
}

if(!isset($_SESSION['mayorEdad']) || $_SESSION['mayorEdad'] == false){
    require 'template/popup.php';
}


if(isset($_POST['entiendo'])){
    if($_POST['entiendo'] == 'si'){
        $_SESSION['avisoCookie'] = true; 
    }}

if(!isset($_SESSION['avisoCookie']) || $_SESSION['avisoCookie'] == false){
    require 'template/avisoCookie.php';
}


?>