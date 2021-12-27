<?php
require_once "configuracion.php";
require 'modelos/generales.modelo.php';
$clases = ModeloGenerales::mdlMostrarTabla("clases", "clase", "");

foreach ($clases as $key => $value) {

      if (!file_exists($value["clase"])){

          $mensaje = "EL ARCHIVO ".strtoupper($value["clase"])." NO EXISTE";

            echo '<!DOCTYPE html> <html lang=&quot;es&quot;>
                  <head>
                  <meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=utf-8&quot; />
                  <meta name=&quot;description&quot; content=&quot;&quot; />
                  <style>             ::-moz-selection {background: #b3d4fc; text-shadow: none;}             ::selection {background: #b3d4fc; text-shadow: none;}
                  html {padding: 30px 10px; font-size: 16px; line-height: 1.4; color: #737373; background: #f0f0f0;
                  -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}             html,
                  input {font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;}             body
                  {max-width:700px; _width: 700px; padding: 30px 20px 50px; border: 1px solid #b3b3b3;
                  border-radius: 4px;margin: 0 auto; box-shadow: 0 1px 10px #a7a7a7, inset 0 1px 0 #fff;                 background: #fcfcfc;}
                  h1 {margin: 0 10px; font-size: 50px; text-align: center;}             h1 span {color: #bbb;}
                  h2 {color: #D35780;margin: 0 10px;font-size: 40px;text-align: center;}             h2 span {color: #bbb;font-size: 80px;}
                  h3 {margin: 1.5em 0 0.5em;}             p {margin: 1em 0;}             ul {padding: 0 0 0 40px;margin: 1em 0;}             .container
                  {max-width: 380px;_width: 480px;margin: 0 auto;}             input::-moz-focus-inner {padding: 0;border: 0;}         </style>     </head>
                  <body>         <div class=&quot;container&quot;>             <h2><span>500</span> Error interno del servidor</h2>
                  <p>¡Vaya! Algo salió mal.<br /><br />'.$mensaje.'.</p>
                  </div>
                  </body>
                  </html>';
          return;
      }

         require_once $value["clase"];



}

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
