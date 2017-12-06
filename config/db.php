<?php 
    class db{
        // Variables de conexión
        private $host = 'localhost';
        private $user = 'root';
        private $password = 'geminis';
        private $namebase = 'alvanitunes';
        
        // Conexion DB
        public function conectar(){
            $conexion_mysql = "mysql:host=$this->host;dbname=$this->namebase";
            $conexionDB = new PDO($conexion_mysql, $this->user, $this->password);
            $conexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Esta linea arregla la codificacion sino no aparecen en la salida en JSON quedan NULL
            $conexionDB -> exec("set names utf8");
            return $conexionDB;
        }
    }