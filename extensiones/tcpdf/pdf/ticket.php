<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

ini_set('display_errors', 0);
ini_set('log_errors', 1);

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
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

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				Fecha: $fecha

				<br><br>
				PUNTO DE VENTA
				
				<br>
				NIT: 71.759.963-9

				<br>
				Dirección: Calle 44B 92-11

				<br>
				Teléfono: 300 786 52 49

				<br>
				FACTURA N.$valorVenta

				<br><br>					
				Cliente: $respuestaCliente[nombre]

				<br>
				Vendedor: $respuestaVendedor[nombre]

				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($productos as $key => $item) {

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque2 = <<<EOF

<table style="font-size:9px;">

	<tr>
	
		<td style="width:160px; text-align:left">
		$item[descripcion] 
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:right">
		$ $valorUnitario Und * $item[cantidad]  = $ $precioTotal
		<br>
		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:80px;">
			 NETO: 
		</td>

		<td style="width:80px;">
			$ $neto
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 IMPUESTO: 
		</td>

		<td style="width:80px;">
			$ $impuesto
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TOTAL: 
		</td>

		<td style="width:80px;">
			$ $total
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			<br>
			<br>
			Muchas gracias por su compra
		</td>

	</tr>

</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>
