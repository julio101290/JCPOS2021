<?php

require_once "../../../controladores/pagos.controlador.php";
require_once "../../../modelos/pagos.modelo.php";

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";


require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

//DATOS EMPRESA

require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";


class imprimirPago{

public $codigo;

public function traerImpresionPago(){

ini_set('display_errors', 0);
ini_set('log_errors', 1);

//TRAEMOS INFORMACION DE LA VENTA
$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);



//TRAEMOS LA INFORMACIÓN DEL PAGO

$idPago = $this->idPago;

$respuestaPago = ControladorPagos::ctrLeerPago($idPago);

$idPago=$respuestaPago[0]["id"]; 

//DATOS DEL PAGO
$importePagado=number_format($respuestaPago[0]["importePagado"]-$respuestaPago[0]["importeDevuelto"]);

$fecha = substr($respuestaVenta["fecha"],0,-8);
//$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//TRAEMOS LA INFORMACION DE LA EMPRESA

$DatosEmpresa= ControladorEmpresa::ctrMostrarEmpresas(null, null);

$nombreEmpresa=$DatosEmpresa[0]["NombreEmpresa"];
$direccionEmpresa=$DatosEmpresa[0]["DireccionEmpresa"];
$RFCEmpresa=$DatosEmpresa[0]["RFC"];
$TelefonoEmpresa=$DatosEmpresa[0]["Telefono"];
$CorreoElectronicoEmpresa=$DatosEmpresa[0]["CorreoElectronico"];

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

//ENCABEZADO

$bloque1 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				NOTA DE PAGO

				<br><br>
				$nombreEmpresa
				
				<br><br>
				$RFCEmpresa

				<br><br>
				$direccionEmpresa

				<br><br>
				$TelefonoEmpresa

				<br><br>
				Folio Pago N.$idPago
				<br><br>
				
				Folio Venta Abonada N.$valorVenta

				<br><br>					
				Cliente: $respuestaCliente[nombre]

				<br>
				Cajero: $respuestaVendedor[nombre]

				<br><br>

				Monto del Pago: $importePagado
				<br>
				TOTAL VENTA $total

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------




// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$pago = new imprimirPago();
$pago -> codigo = $_GET["codigo"];
$pago -> idPago = $_GET["idPago"];
$pago -> traerImpresionPago();

?>
