<?php

require_once "../controladores/perfiles.controlador.php";
require_once "../modelos/perfiles.modelo.php";

class AjaxPerfiles{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idPerfil;

	public function ajaxEditarPerfil(){

		$item = "perfil";
		$valor = $this->idPerfil;


		$respuesta = ControladorPerfiles::ctrMostrarPerfiles($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR PERFIL
=============================================*/
if(isset($_POST["idPerfil"])){

	$editar = new AjaxPerfiles();
	$editar -> idPerfil = $_POST["idPerfil"];
	$editar -> ajaxEditarPerfil();

}
