<?php 
function conectar(){ 
    $user="root"; 
    $pass=""; 
    $server="localhost"; 
    $nombrebd="banco_bd"; 
    $conexion=mysqli_connect($server,$user,$pass,$nombrebd) or die ("error enla conexio".mysqli_error()); 
    
    return $conexion; 
} 
?>