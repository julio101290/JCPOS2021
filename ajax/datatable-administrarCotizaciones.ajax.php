<?php

/* 
 * Copyright (C) 2020 Julio Cesar Leyva Rodriguez
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../modelos/clientes.modelo.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/utilerias.controlador.php";
session_start();

error_reporting(E_ERROR | E_PARSE);
class TablaVentas{

    /*=============================================
     MOSTRAR LA TABLA DE VENTAS
    =============================================*/ 

    public function mostrarTablaVentas($columnas,$filtros,$busqueda){


        //TOTAL RENGLONGLES EN LA TABLA VENTAS

        $pendientePorCobrar = $this->pendientePorCobrar;
        $soloCobrado = $this->soloCobrado;
        $pendientes =$this->pendientes;
        $cliente = $this->cliente;
        $fechaInicial = $this->fechaInicial;
        $fechaFinal = $this->fechaFinal;
       



        $cotizaciones = ModeloVentas::mdlRangoFechasVentasCotizaciones("ventas"
                                                                ,$fechaInicial
                                                                ,$fechaFinal
                                                                ,$_REQUEST
                                                                ,"S"
                                                  );
        $cotizacionesRenglones = ModeloVentas::mdlRangoFechasVentasCotizaciones("ventas"
                                                                ,$fechaInicial
                                                                ,$fechaFinal
                                                                ,$_REQUEST
                                                                ,"N"
                                                  );
   
        
        $totalRenglones=count($cotizacionesRenglones);


	
									

 		
  		if($totalRenglones == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		

      if(isset($filtros["draw"])){
        $filtros2["draw"]=$filtros["draw"];
      }else{
        $filtros2["draw"]=1;
      }

  		$datosJson = '
      {
        "draw": '.intval($filtros2["draw"]).',
        "recordsTotal":'.intval($totalRenglones).',
        "recordsFiltered": '.intval($totalRenglones).',

		  "data": [';

		  for($i = 0; $i < count($cotizaciones); $i++){

        //BOTONES

            $botones = "<div class='btn-group'><button class='btn btn-info btnImprimirFactura'  required data-toggle='tooltip' data-placement='top' title='Imprimir' codigoVenta='".$cotizaciones[$i]["id"]."''> <i class='fa fa-print'></i> </button>";

                    if($_SESSION["modificarVentas"] == "on"){

                      $botones .= "<button class='btn btn-warning btnEditarVenta' required data-toggle='tooltip' data-placement='top' title='Editar Venta'idVenta='".$cotizaciones[$i]["id"]."'><i class='fa fa-pencil'></i></button>";
                    }

                    if($_SESSION["eliminarVentas"] == "on"){
                     $botones .= "<button class='btn btn-danger btnEliminarVenta' required data-toggle='tooltip' data-placement='top' title='Eliminar' idVenta='".$cotizaciones[$i]["id"]."''><i class='fa fa-times'></i></button>";

                    }

                  
                    
                    $botones= "<div class='btn-group'>";
                    
                    $botones.="  <button class='btn btn-info btnImprimirCotizacion' required data-toggle='tooltip' data-placement='top' title='Imprimir Cotizaciones'";
                    $botones.="    codigoVenta='".$cotizaciones[$i]["UUID"]."'>";
                    $botones.="    <i class='fa fa-print'></i>";
                    $botones.="  </button>";
                      
                    //BOTON DE ENVIAR CORREO
                    $botones.= "<button class='btn btn-success btnEnviarCorreo'";
                    $botones.= " codigoVenta='".$cotizaciones[$i]["UUID"]."'";
                    $botones.= "  data-toggle='modal' data-target='#enviarCorreo' data-dismiss='modal'";
                    $botones.= "   tipoVenta='COT' nombreCliente='".$cotizaciones[$i]["cotizarA"]."'"; 
                    $botones.= " correoCliente='".$respuestaCliente["email"]."'";
                    $botones.= "   required data-toggle='tooltip' data-placement='top' title='Enviar Correo'>";
                    $botones.= "<i class='fa fa-send'></i>";

                    $botones.= " </button>";



                  

                    if($_SESSION["modificarCotizaciones"] == "on"){

                         $botones .= "<button class='btn btn-warning btnEditarCotizacion'"; 
                         $botones .= "required data-toggle='tooltip' data-placement='top' title='Editar Cotización'";
                         $botones .= "       idVenta='".$cotizaciones[$i]["id"]."'><i class='fa fa-pencil'></i></button>";
                    }

                      
                    if($_SESSION["eliminarCotizaciones"] == "on"){
                      $botones .= "<button class='btn btn-danger btnEliminarCotizacion'"; 
                      $botones .= "        required data-toggle='tooltip' data-placement='top' title='Eliminar Cotización'";
                      $botones .= "      idVenta='".$cotizaciones[$i]["id"]."'><i class='fa fa-times'></i></button>";
                    }
                      
                      if(date("Y-m-d")>$cotizaciones[$i]["FechaVencimiento"]){
                           if (is_numeric($cotizaciones[$i]["codigoVenta1"])){
                               
                                $botones .= "<button class='btn bg-navy' disabled='true' idVenta='".$cotizaciones[$i]['id']."'><STRONG>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; VENTA ".$cotizaciones[$i]["codigoVenta1"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</STRONG></i></button>";
                           }else{
                             $botones .= "<button class='btn bg-navy ' disabled='true' idVenta='".$cotizaciones[$i]["id"]."'><STRONG>COTIZACION VENCIDA</STRONG></i></button>";
                           }
                           }
                        else{
                          if (is_numeric($cotizaciones[$i]["codigoVenta1"])){

                              $botones .= "<button class='btn bg-navy' disabled='true' idVenta='".$cotizaciones[$i]['id']."'><STRONG>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; VENTA ".$cotizaciones[$i]["codigoVenta1"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</STRONG></i></button>";
                          }
                          else{

                              $botones .= "<button class='btn bg-navy btnCrearVentaCotizacion' idVenta='".$cotizaciones[$i]["id"]."'><STRONG>GENERAR VENTA</STRONG></i></button>";
                          }

                        }
                      
                       $botones .= "<button class='btn bg-navy btnCopiarCotizacion' idCotizacion='".$cotizaciones[$i]["id"]."'><STRONG>COPIAR</STRONG></i></button></div>";

                   

                   
                
      
                    
                    
                    $cliente = ModeloClientes::mdlMostrarClientes("clientes", "id", $cotizaciones[$i]["id_cliente"]);
                    $vendedor = ModeloUsuarios::mdlMostrarUsuarios("usuarios", "id", $cotizaciones[$i]["id_vendedor"]);


                    $datosJson .='[
                                "'.$cotizaciones[$i]["id"].'",
                                "'.$cotizaciones[$i]["codigo"].'",
                                "'.$ventas["cotizarA"].'",
                                "'.$cliente["nombre"].'",
                                "'.$vendedor["nombre"].'",
                                "'.number_format($cotizaciones[$i]["neto"],2).'",
                                "'.number_format($cotizaciones[$i]["total"],2).'",
                                "'.$cotizaciones[$i]["fecha"].'",
                                "'.$cotizaciones[$i]["FechaVencimiento"].'",
                                 "'.$botones .'"
                                ],';

		  }



		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA 
=============================================*/ 

$activarVentas= new TablaVentas();




          if(isset($_POST["pendientePorCobrar"])){
            $activarVentas -> pendientePorCobrar=$_POST["pendientePorCobrar"];

          }else{
            $activarVentas -> pendientePorCobrar="n";
          }
          
          if(isset($_POST["soloCobrado"])){
            $activarVentas -> soloCobrado=$_POST["soloCobrado"];
          }else{
            $activarVentas -> soloCobrado= "n";
          }
          


          if(isset($_POST["pendientes"])){
            $activarVentas -> pendientes=$_POST["pendientes"];
          }else{
            $activarVentas -> pendientes ="n";
          }

          if(isset($_POST["cliente"])){
            $activarVentas -> cliente=$_POST["cliente"];
          }else{
            $activarVentas -> cliente="n";
          }

          if(isset($_POST["fechaInicial"])){


            $fechaInicial = $_POST["fechaInicial"];
            $fechaFinal = $_POST["fechaFinal"];

            $activarVentas -> fechaInicial=$_POST["fechaInicial"];
            $activarVentas -> fechaFinal=$_POST["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;
            $activarVentas -> fechaInicial=null;
            $activarVentas -> fechaFinal=null;

         

          }

$request=$_REQUEST;

$busqueda=$_REQUEST;

$columnas="";

$activarVentas -> mostrarTablaVentas($columnas,$request,$busqueda);




