<?php

$item = null;
$valor = null;

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

$arrayVendedores = array();
$arraylistaVendedores = array();

foreach ($ventas as $key => $valueVentas) {

  foreach ($usuarios as $key => $valueUsuarios) {

    if($valueUsuarios["id"] == $valueVentas["id_vendedor"]){

        #Capturamos los vendedores en un array
        array_push($arrayVendedores, $valueUsuarios["nombre"]);

        #Capturamos las nombres y los valores netos en un mismo array
        $arraylistaVendedores = array($valueUsuarios["nombre"] => $valueVentas["neto"]);

         #Sumamos los netos de cada vendedor

        foreach ($arraylistaVendedores as $key => $value) {

            $sumaTotalVendedores[$key] += $value;

         }

    }
  
  }

}

#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayVendedores);

?>


<!--=====================================
VENDEDORES
======================================-->

<div class="box box-success">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Vendedores</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart1" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [

  <?php
    
    foreach($noRepetirNombres as $value){

      echo "{y: '".$value."', a: '".$sumaTotalVendedores[$value]."'},";

    }

  ?>
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>
