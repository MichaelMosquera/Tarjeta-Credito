<?php
 //la IP muestra uno por que es un servidor local
    $ip=$_SERVER['REMOTE_ADDR'];
    date_default_timezone_set('America/Bogota');;
    $horaActual=date('Y-m-d H:i:s');
    include("conexionBD.php");
    $conexion=conectar();
    
    if (isset($_POST['numeroTarjeta'])) {
        $numeroModal=$_POST['numeroTarjeta'];
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

   
</head>
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
                    <h3>Pagos</h3>
                    <img src="https://img.icons8.com/wired/64/000000/pay-wall.png"/>

                </center>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ingrese tarjeta</label>
                        <input type="text" class="form-control" name="numeroTarjeta" id="exampleInputEmail1" aria-describedby="emailHelp" required minlength="13" maxlength="18" onkeypress="return validaNumericos(event)">
                        <small id="emailHelp" class="form-text text-muted">Número de tarjeta con la cual se va a realizar el pago</small>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Consultar">
                </form>
            </div>
        </div>
        <div>

        </div>
    </div>

    <!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Pago</h1>
            </div>
            <div class="modal-body">
                
                <h1>Información personal</h1>
                <form role="form" method="POST" action="">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">Número de la tarjeta</label>
                        <div><?php
                            echo '<input type="text" class="form-control input-lg" name="tarjetaPago" value="'.$numeroModal.'"  >'
                            ?>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="control-label">Nombre completo</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="nombre" value="">
                        </div>
                    </div>                   
                    <div class="form-group">
                        <label class="control-label">Monto a pagar</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="monto"  onkeypress="return validaNumericos(event)">
                        </div>
                    </div>                                     
                    <div class="form-group">
                        <div>
                            <button type="submit" name="consignar" class="btn btn-success" value="pedro">
                                Consignar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>

<?php 

    if (isset($_POST['numeroTarjeta'])) {

        
        $numeroTarjeta=$_POST['numeroTarjeta'];
        $tarjeta=$_POST['numeroTarjeta'];

        $Invalida="";
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
            $Invalida="no";
        } else {
            $Invalida="si";
        }
        if($Invalida=="no"){

        include("funciones.php");
        luhn($numeroTarjeta);

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
        $hash = Password::hash($numeroTarjeta);

        $consu="select count(*) as tarjetas from tarjetas where Num_Tarjeta='".$hash."'";
        $rs=mysqli_query($conexion,$consu);
        $fila=mysqli_fetch_array($rs);

        if ($fila['tarjetas']>0) {
            $horaActual=date('Y-m-d');
            
            $consu="select count(*) as historia from historialSolicitud where tarjetaHistoria='".$numeroTarjeta."' and cantidadHistoria=3 
            and  ipHistoria='".$ip."' and date(fechaHistoria) like '".$horaActual."'";
            
            $rs=mysqli_query($conexion,$consu);
            $fila=mysqli_fetch_array($rs);

            if ($fila['historia']==0) {
                $horaActual=date('Y-m-d');
                echo "<script>$('#ModalLoginForm').modal('show');</script>";
                $consu="select count(*) as historia from historialSolicitud where tarjetaHistoria='".$numeroTarjeta."' and cantidadHistoria!=0 and  ipHistoria='".$ip."'and  date(fechaHistoria) like'".$horaActual."'";
                $rs=mysqli_query($conexion,$consu);
                $fila=mysqli_fetch_array($rs);
                if ($fila['historia']!=0) {
                    $horaActual=date('Y-m-d');
                    $consu="update historialSolicitud set cantidadHistoria=cantidadHistoria+1 
                            where ipHistoria='".$ip."' and tarjetaHistoria='".$numeroTarjeta.
                            "' and date(fechaHistoria) like '".$horaActual."'";
                            
                    $rs=mysqli_query($conexion,$consu);
                }else{
                    $consu="insert into historialSolicitud (idHistoria, ipHistoria, tarjetaHistoria, fechaHistoria, cantidadHistoria)
                    values ( '','" . $ip . "','" . $numeroTarjeta . "','" . $horaActual . "' , " . 1 . ")";
                    $rs=mysqli_query($conexion,$consu);
                }
            }else{
                echo "<script>alert('Ocurrio un problema, solicitud negada por exceso de peticiones, has sido baneado por el resto del día con esta ip')</script>";
                exit();
            }
        }else{
            $nombreFranquicia = validaFranquicia( $numeroTarjeta);
            //saca todos los numeros de el cifrado
            $cadenaNumeros=mb_ereg_replace("[^0-9]","",$hash);
            //saca array de 18 caracteres
            $p = str_split($cadenaNumeros,18);
    
            $cadenas2=0;
            $token6="";
    
            for ($i=0; $i < 3 ; $i++) { 
                $cadenas1 = $p[$i];
                $cadenas2 =  str_split($cadenas1,6);
                $token6 = $token6 . $cadenas2[0];
            }
            $ahora = date("Y-m-d");
            $consu="insert into tarjetas (idTarjeta, Num_Tarjeta, franquicia, token, fechaCreacion)
            values( '','".$hash."','".$nombreFranquicia."','".date('Y-m-d')."')";
            $rs=mysqli_query($conexion,$consu);

            if ($rs) {
                echo "<script>alert('La tarjeta ingresada no existia en la base de datos, por tal motivo fue registrada. Intenta de nuevo para realizar el pago')</script>";
            }else{
                echo "<script>alert('Ocurrio un problema con el registro')</script>";

            }

        }
    }
    }
    //registro pago
    if(isset($_POST['consignar'])){
        $nombreCompleto = $_POST['nombre'];
        $monto = $_POST['monto'];
        $tarjetaPago = $_POST['tarjetaPago'];

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
        $hash = Password::hash($tarjetaPago);

        $consu="insert into pago (idPago, Num_TarjetaPago, montoPago,fechapago,clientePago)
            values ( '','".$hash."','".$monto."','".date('Y-m-d')."','".$nombreCompleto."')";
        $rs=mysqli_query($conexion,$consu);
        if ($rs) {
            echo "<script>alert('registro con exito')</script>";
        }else{
            echo "<script>alert('Ocurrio un problema con el registro')</script>";

        }
    }
    

    

?>