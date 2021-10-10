<?php

if(isset($_GET["fechaInicial"])){

  $variables["fechaInicial"] =  $_GET["fechaInicial"];
  $variables["fechaFinal"] =  $_GET["fechaFinal"] ;
  $variables["conFecha"] =  "SI" ;

}else{
  $variables["fechaInicial"] =  "19900101";
  $variables["fechaFinal"] =  "19900101";
  $variables["conFecha"] =  "NO" ;
}

$ventasComprador = ModeloVentas::mdlMostrarVentasVendedor($variables);

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

    foreach ($ventasComprador as $key => $value) {


      echo "{y: '".$value["nombre"]."', a: '".$value["total"]."'},";

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
