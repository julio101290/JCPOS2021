<?php
require_once "../controladores/empresa.controlador.php";
require_once "../modelos/empresa.modelo.php";


class AjaxEmpresa{

    /*=============================================
    EDITAR EMPRESA
    =============================================*/ 


    public function ajaxEditarEmpresa(){



        $item =  null;
        $valor = null;
        $orden = null;

        $respuesta = ControladorEmpresa::ctrMostrarEmpresas($item,$valor);

        echo json_encode($respuesta);

  }



}




/*=============================================
EDITAR MEDIDA
=============================================*/ 

if(isset($_POST["idEmpresa"])){

  $editarEmpresa = new AjaxEmpresa();
  $editarEmpresa -> ajaxEditarEmpresa();

}


