<?php


$pendientes = ControladorPagos::ctrPagosPendientes();

 ?>


<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Cobranza pendiente</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

      <button type="button" class="btn btn-box-tool" data-widget="remove">

        <i class="fa fa-times"></i>

      </button>

    </div>

  </div>
  
  <div class="box-body">

    <ul class="products-list product-list-in-box">

    <?php

    for($i = 0; $i < 10; $i++){

      


      if($pendientes[$i]["PendientePorPagar"]>0){
          echo '<li class="item">


            <div class="product-info">

              <a href="index.php?ruta=ventas&cliente='.$pendientes[$i]["id"].'&pendientePorCobrar=s"  class="product-title">

                '.$pendientes[$i]["nombre"].'

                <span class="label label-warning pull-right">$'.number_format($pendientes[$i]["PendientePorPagar"],2).'</span>

              </a>
        
           </div>

          </li>';
        }

    }

    ?>

    </ul>

  </div>

  <div class="box-footer text-center">

    <a href="index.php?ruta=ventas&pendientePorCobrar=s" class="uppercase">Ver toda la cobranza pendiente</a>
  
  </div>

</div>
