<?php
require_once "../controladores/CorreoSaliente.controlador.php";
require_once "../modelos/correo.modelo.php";


class AjaxDatosCorreo{

    /*=============================================
    EDITAR EMPRESA
    =============================================*/ 


    public function ajaxEditarCorreo(){


        $respuesta = ControladorCorreo::ctrMostrarCorreo();

        echo json_encode($respuesta);

  }



}




/*=============================================
MOSTRAR CORREO
=============================================*/ 


  $editarCorreo = new AjaxDatosCorreo();
  $editarCorreo -> ajaxEditarCorreo();



