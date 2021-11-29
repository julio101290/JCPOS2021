<?php

require_once "../controladores/caja.controlador.php";
require_once "../modelos/caja.modelo.php";


class TablaProductosCajas{

  /*=============================================
   MOSTRAR LA TABLA DE CAJAS
    =============================================*/

  public function mostrarTablaCajas(){

    $item = null;
      $valor = null;
      $orden = "id";

      $cajas = ControladorCaja::ctrMostrarCajas($item, $valor, $orden);

      if(count($cajas) == 0){

        echo '{"data": []}';

        return;
      }

      $datosJson = '{
      "data": [';

      for($i = 0; $i < count($cajas); $i++){





        if($cajas[$i]["fecha_cierre"]==""){
                  $botones =  "<button class='btn btn-danger btnCerrarCaja'  idCaja='".$cajas[$i]["id"]."' data-toggle='modal' data-target='#modalCerrarCaja'>Cerrar Caja</button>";
      }else{
          $botones =  "<button class='btn btn-danger'  idCaja='".$cajas[$i]["id"]."' data-toggle='modal'>Caja Cerrada</button>";
      }

        $datosJson .='[
            "'.$cajas[$i]["id"].'",
            "'.$cajas[$i]["nombreUsuario"].'",
            "'.$cajas[$i]["fecha_apertura"].'",
            "'.$cajas[$i]["fecha_cierre"].'",
            "'.$cajas[$i]["importe_apertura"].'",
            "'.$cajas[$i]["total_ventas"].'",
            "'.$cajas[$i]["diferencia"].'",
            "'.$cajas[$i]["observaciones"].'",
            "'.$botones.'"
          ],';

      }

      $datosJson = substr($datosJson, 0, -1);

     $datosJson .=   ']

     }';

    echo $datosJson;

  }


}

/*=============================================
ACTIVAR TABLA CAJAS
=============================================*/
$mostrarCajas = new TablaProductosCajas();
$mostrarCajas -> mostrarTablaCajas();
