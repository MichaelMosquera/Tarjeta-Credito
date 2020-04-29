<?php
include("conexionBD.php");
$conexion=conectar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style>
    .contenedor{
        display: grid;
        grid-template-columns: 33% 33% 33%;
        margin: 50px;
        
        
    }

</style>
<script>
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}

</script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="tarjeta.php">Inicio <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="pagos.php">Pagar</a>
    </div>
  </div>
</nav>
    <div class="contenedor" >
        <div>

        </div>
        <div style="background: silver;" >
            <div style="margin: 20%">
                <form action="" method="POST">
                <center>
                    <h3>Bienvenido al portal</h3>
                    <img src="https://img.icons8.com/dotty/80/000000/mastercard-credit-card.png"/>
                </center>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ingrese tarjeta</label>
                        <input type="text" class="form-control" name="numeroTarjeta" id="exampleInputEmail1" aria-describedby="emailHelp" required onkeypress="return validaNumericos(event)" minlength="13" maxlength="18">
                        <small id="emailHelp" class="form-text text-muted">Por favor ingrese un numero de tarjeta</small>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Ingresar">
                </form>
            </div>
        </div>
        <div>

        </div>
    </div>
</body>
</html>

<?php

    if(isset($_POST['numeroTarjeta'])){
       
       
        $tarjeta = $_POST['numeroTarjeta'];
        $franquicia = $_POST['numeroTarjeta'];
        $Inavlida="";
        $resultado = 0;
        $i = 1;
        $last4 = substr($tarjeta, -4,4);
        $tarjeta = str_split($tarjeta);

        $tarjeta = array_reverse($tarjeta);
        foreach($tarjeta as $digito){
            if ($i % 2 == 0) {
                $digito *= 2;

                if ($digito >9) {
                    $digito -= 9;
                }
            }
            $resultado += $digito;

            $i++;

        }

        if($resultado % 10 == 0){
            echo "<strong style='color:green;'>Su numero de tarjeta es valida y finaliza en ". $last4."</strong>";
            $Inavlida="no";
        } else {
            echo "<strong style='color:red;'>Su numero de tarjeta es invalida y finaliza en ". $last4. "</strong>";
            echo "<br/>";
            echo "<strong style='color:red;'>Por favor ingrese uno nuevo</strong>";
            $Inavlida="si";
        }

        if($Inavlida=="no"){
            //franquicia
            function validaFranquicia($nombreFranquicia) {
                if($nombreFranquicia !== "") {
                    //Mastercard
                    if(preg_match("/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/", $nombreFranquicia)) {
                        $nombreFranquicia ="Mastercard";
                        return $nombreFranquicia;
                    }else{
                        //visa
                        if(preg_match("/^4[0-9]{12}(?:[0-9]{3})?$/", $nombreFranquicia)) {
                            $nombreFranquicia ="visa";
                            return $nombreFranquicia;
                        }else{
                            //Amex Card
                            if(preg_match("/^3[47][0-9]{13}$/", $nombreFranquicia)) {
                                $nombreFranquicia ="Amex Card";
                                return $nombreFranquicia;
                            }else{
                                //BCGlobal
                                if(preg_match("/^(6541|6556)[0-9]{12}$/", $nombreFranquicia)) {
                                    $nombreFranquicia ="BCGlobal";
                                    return $nombreFranquicia;
                                }else{
                                    //Carte Blanche Card
                                    if(preg_match("/^389[0-9]{11}$/", $nombreFranquicia)) {
                                        $nombreFranquicia ="Carte Blanche Card";
                                        return $nombreFranquicia;
                                    }else{
                                        //Diners Club Card
                                        if(preg_match("/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/", $nombreFranquicia)) {
                                            $nombreFranquicia ="Diners Club Card";
                                            return $nombreFranquicia;
                                        }else{
                                            //Discover
                                            if(preg_match("/^6(?:011|5[0-9]{2})[0-9]{3,}$/", $nombreFranquicia)) {
                                                $nombreFranquicia ="Discover";
                                                return $nombreFranquicia;
                                            }else{
                                                //JCB Card
                                                if(preg_match("/^(?:2131|1800|35\d{3})\d{11}$/", $nombreFranquicia)) {
                                                    $nombreFranquicia ="JCB Card";
                                                    return $nombreFranquicia;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            }
            
            $nombreFranquicia = validaFranquicia($franquicia);
            


            class Password {
                const SALT = 'EstoEsUnSalt';
                public static function hash($password) {
                    return hash('sha512', self::SALT . $password);
                }
                public static function verify($password, $hash) {
                    return ($hash == self::hash($password));
                }
            }
            // Crear la contraseña:
            $hash = Password::hash($franquicia);
            $cadenaNumeros=mb_ereg_replace("[^0-9]","",$hash);
            
            $p = str_split($cadenaNumeros,18);
        
            $cadenas2=0;
            $token6="";
        
            for ($i=0; $i < 3 ; $i++) { 
                $cadenas1 = $p[$i];
                $cadenas2 =  str_split($cadenas1,6);
                $token6 = $token6 . $cadenas2[0];
            }

            $consu="select count(*) as tarjetas from tarjetas where Num_Tarjeta='".$hash."'";
            $rs=mysqli_query($conexion,$consu);
            $fila=mysqli_fetch_array($rs);
            if ($fila['tarjetas']>0) {
                echo "<script>alert('Esta tarjeta ya existe en la Base de datos')</script>";
                echo "<strong style='color:green;'>, pero ya existe en la base de datos </strong>";
                        exit();
            }
            $ahora = date("Y-m-d");
            $consu="insert into tarjetas (idTarjeta, Num_Tarjeta, franquicia, token, fechaCreacion)
            values( '','".$hash."','".$nombreFranquicia."','".$token6."','".$ahora."')";
            $rs=mysqli_query($conexion,$consu);

            if ($rs) {
                echo "<script>alert('registro con exito')</script>";
            }else{
                echo "<script>alert('Ocurrio un problema con el registro')</script>";

            }
        }
    }
  
    
    
    
    
?>