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

$itemVenta = "codigo";
$valorVenta = str_pad($this->codigo,5,"0",STR_PAD_LEFT);

$respuestaVenta = ControladorVentas::ctrTraerCotizacion($valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);
$metodoPago=$respuestaVenta["metodo_pago"];
$FechaVencimiento = $respuestaVenta["FechaVencimiento"];
$plazoEntrega= $respuestaVenta["plazoEntrega"];
//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//SI EL CLIENTE ES PUBLICO EN GENERAL QUE PONGA EN LA COTIZACION EL NOMBRE DEL CONTACTO

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR
if($valorCliente =1){
	$respuestaCliente[nombre]= $respuestaVenta["cotizarA"];;
}

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
$pdf->startPageGroup();

$pdf->AddPage();


// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table cellspacing="0" style="width: 100%;">
		
		<tr>
	
			<td style="width:150px"><img src="../../../vistas/img/plantilla/logoReportes.png"></td>

			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
				
				<div style="font-size:8.5px; text-align:center;">
					
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
			<td style="background-color:white; width:110px; text-align:center; color:red" font-weight:bold><br>COTIZACIÓN<br>$valorVenta</td>

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
           <td style="width: 50%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">ATENCION A
           </td>
           <td style="width: 50%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">OBSERVACIONES
           </td>
        </tr>
		<tr>
			
			<td >

				
				Cliente: $respuestaCliente[nombre]
				
				<br>
				Telefono: $respuestaCliente[telefono]
				<br>
				E-Mail: $respuestaCliente[email]
				<br>
			</td>
			<td >
				$respuestaVenta[Observaciones]
			</td>
	

		</tr>

		<tr>
			
			<td style="width: 35%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">VENDEDOR
			</td>
			<td style="width: 14%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">FECHA 
			</td>
			<td style="width: 30%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">FECHA DE VENCIMIENTO
			</td>
			<td style="width: 21%; background-color:#2c3e50; padding: 4px 4px 4px; font-weight:bold;  color:white;">PLAZO DE ENTREGA
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
					$FechaVencimiento
				</td>

				<td>
					$plazoEntrega
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

$valorUnitario = number_format($item["precio"], 2);

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

			<td $clase width:100px; text-align:center"> 
				$valorUnitario
			</td>

			<td $clase width:100px; text-align:right">$ 
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

			<td style="color:#333; background-color:white; width:340px; text-align:right"></td>

			<td style="border-bottom: 0px solid #666; background-color:white; width:100px; text-align:right"></td>

			<td style="border-bottom: 0px solid #666; color:#333; background-color:white; width:100px; text-align:right"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 0px solid #666; color:#333; background-color:white; width:340px; text-align:right"></td>

			<td style="border: 0px solid #666;  background-color:white; width:100px; text-align:right">
			Subtotal:
			</td>

			<td style="border: 0px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				 $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 0px solid #666; color:#333; background-color:white; width:340px; text-align:right"></td>

			<td style="border: 0px solid #666; background-color:white; width:100px; text-align:right">
	         IVA:
			</td>
		
			<td style="border: 0px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				 $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 0px solid #666; color:#333; background-color:white; width:340px; text-align:right"></td>

			<td style="border: 0px solid #666; background-color:white; width:100px; text-align:right">
				Total:
			</td>
			
			<td style="border: 0px solid #666; color:#333; background-color:white; width:100px; text-align:right">
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

//SOLO TRAE ARCHIVO
//$pdf->Output(getcwd().'/PDF/COTIZACION'.$valorVenta.'.pdf', 'F');
 
 $pdf->Output(getcwd().'/PDF/COTIZACION'.$valorVenta.'.pdf', 'F');
//MUESTRA ARCHIVO EN OTRA VENTANA	
$pdf->Output(getcwd().'/PDF/COTIZACION'.$valorVenta.'.pdf', 'FI');


}

}

$factura = new imprimirFactura();

if(isset($_GET["codigo"])){
	$factura -> codigo = $_GET["codigo"];
}

if(isset($_POST["codigo"])){
	$factura -> codigo = $_POST["codigo"];
}




$factura -> traerImpresionFactura();

?>
