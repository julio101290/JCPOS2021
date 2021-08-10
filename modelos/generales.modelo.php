<?php

require_once "conexion.php";

class ModeloGenerales {
    
    /* =============================================
      MOSTRAR TABLA GENERICA
      ============================================= */

    static public function mdlMostrarTabla($tabla,$campos,$donde) {


        //GEN_SUCURSALES

        $stmt = Conexion::conectar()->prepare("SELECT $campos
                                                FROM $tabla a
                                                WHERE 1=1
                                                $donde
                                             
               ");

  

            try {
                $stmt->execute();
            
            return $stmt->fetchAll();
            }
        
        
        catch(Swoole\MySQL\Exception $e){

            /*
            $arr = $stmt->errorInfo();
            return $arr[2];
             * 
             */
            $e->getMessage();
        }



        $stmt->close();

        $stmt = null;
    }
    
    
    
        /* =============================================
      EJECUTA CONSULTA
      ============================================= */

    static public function mdlEjecutaConsulta($consulta) {


        //GEN_SUCURSALES

        $stmt = Conexion::conectar()->prepare($consulta);

  

            try {
                $stmt->execute();
            
            return $stmt->fetchAll();
            }
        
        
        catch(Swoole\MySQL\Exception $e){

            /*
            $arr = $stmt->errorInfo();
            return $arr[2];
             * 
             */
            $e->getMessage();
        }



        $stmt->close();

        $stmt = null;
    }
    
    
        /* =============================================
      GENERAR UUIDD
      ============================================= */

    static public function mdlGeneraUUID() {

        $stmt = Conexion::conectar()->prepare("SELECT uuid() as uuid
                                             
               ");

        $stmt->execute();

            if ($stmt->execute()) {

            $uuid = $stmt->fetch();
            
            return $uuid["uuid"];
        } else {


            $arr = $stmt->errorInfo();
            return $arr[2];
        }



        $stmt->close();

        $stmt = null;
    }
    
    
        static public function mdlFechaHoraActual() {

        $stmt = Conexion::conectar()->prepare("SELECT now() as fechaHora
                                             
               ");

        $stmt->execute();

            if ($stmt->execute()) {

            $fechaHora = $stmt->fetch();
            
            return $fechaHora["fechaHora"];
        } else {


            $arr = $stmt->errorInfo();
            return $arr[2];
        }



        $stmt->close();

        $stmt = null;
    }

}
