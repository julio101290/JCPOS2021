<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

//DATOS EMPRESA

require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "UUID";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$codigo=$respuestaVenta["codigo"];
$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);
$metodoPago=$respuestaVenta["metodo_pago"];
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

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table cellspacing="0" style="width: 100%;">
		
		<tr>
	
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
				
				<div style="font-size:8.5px; text-align:center; line-height:10px;">
					
					 <span style="color: #34495e;font-size:14px;font-weight:bold">
					 	$nombreEmpresa
				 	 </span>

					<br>
					$direccionEmpresa
					
					<br>
					$RFCEmpresa
					<br>
					$TelefonoEmpresa
					<br>
					$CorreoElectronicoEmpresa
				</div>

			</td>
			<td style="background-color:white; width:110px; text-align:center; color:red" font-weight:bold><br>FACTURA N.<br>$codigo</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF
	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:0px 10px;">
		
		 <tr>
           <td style="width: 50%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">FACTURAR A
           </td>
        </tr>
		<tr>
			
			<td >

				Cliente: $respuestaCliente[nombre]
				<br>
				Direccion: $respuestaCliente[direccion]
				<br>
				Telefono: $respuestaCliente[telefono]
				<br>
				E-Mail: $respuestaCliente[email]
				<br>
			</td>

	

		</tr>

		<tr>
			
			<td style="width: 35%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">VENDEDOR:
			</td>
			<td style="width: 25%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">FECHA 
			</td>
			<td style="width: 40%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">FORMA DE PAGO
			</td>

		</tr>	
		<tr>
				<td>
					$respuestaVendedor[nombre]
				</td>

				<td>
					$fecha
				</td>

				<td>
					$metodoPago
				</td>

		</tr>

		<tr>
		
			<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="width: 260px; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white; text-align:center">Producto</td>
		<td style="width: 80px; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white; text-align:center">Cantidad</td>
		<td style="width: 100px; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white; text-align:center">Valor Unit.</td>
		<td style="width: 100px; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
$contador=0;
foreach ($productos as $key => $item) {

$contador=$contador+1;
$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

	if ($contador%2==0){
		$clase='style=" background-color:#ecf0f1; padding: 3px 4px 3px; ';
	} else {
		$clase='style="background-color:white; padding: 3px 4px 3px; ';
	}

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td  $clase width:260px; text-align:center">
				$item[descripcion]
			</td>

			<td $clase width:80px; text-align:center">
				$item[cantidad]
			</td>

			<td $clase width:100px; text-align:center">$ 
				$item[precio]
			</td>

			<td $clase width:100px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 0px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 0px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 0px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 0px solid #666;  background-color:white; width:100px; text-align:center">
				Neto:
			</td>

			<td style="border: 0px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 0px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 0px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 0px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 0px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 0px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 0px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>


	</table>
	<br>
	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por su compra!</div>
EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');




// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//CORRIGE ERROR 17778 TCPDF ERROR: Some data has already been output, can't send PDF file
ob_end_clean();

//$pdf->Output('factura.pdf', 'D');


 $pdf->Output(getcwd().'/PDF/factura'.$valorVenta.'.pdf', 'FI');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>
