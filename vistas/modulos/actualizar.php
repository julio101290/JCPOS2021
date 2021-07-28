<?php

/* 
 * Copyright (C) 2021 Julio Cesar Leyva Rodriguez
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


if($_SESSION["actualizar"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}


function execPrint($command) {
    $result = array();
    exec($command, $result);
    print("<pre>");
    foreach ($result as $line) {
        print($line . "\n");
    }
    print("</pre>");
}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>

      Actualizar  
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Actualizar</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  



      </div>

      <div class="box-body">
        
 
<?php

execPrint("git pull");
execPrint("git status");
execPrint("git log");

?>

      </div>

    </div>

  </section>

</div>
