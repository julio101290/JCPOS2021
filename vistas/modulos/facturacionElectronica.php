<?php
if($_SESSION["facturacionElectronica"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>


<div class="content-wrapper">

  <iframe src="https://portalcfdi.facturaelectronica.sat.gob.mx/" width=100% height=1000  name="frmFacturacion" id="frmFacturacion"  > 


  </iframe>
</div>

<script type="text/javascript">


		
		//$("#Ecom_User_ID").val("ASD");
</script>
  





