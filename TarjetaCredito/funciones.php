<?php 

function luhn($tarjeta){
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
        } else {
            echo "<strong style='color:red;'>Su numero de tarjeta es invalida y finaliza en ". $last4. "</strong>";
            echo "<br/>";
            echo "<strong style='color:red;'>Por favor ingrese uno nuevo</strong>";
        }
}

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

?>