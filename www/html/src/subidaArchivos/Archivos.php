<?php


class Archivos
{
    private $conexion;

    public function __construct()
    {
        //Se utiliza ruta absoluta para modo de resolucion del problema, esto no es correcto hacerlo
        $this->conexion = require_once '/var/www/html/src/conexion.php';
    }

    public function CreateTable()
    {
        $createTables = [
            'DROP TABLE IF EXISTS archivos;
             DROP TABLE IF EXISTS tipos;
             DROP TABLE IF EXISTS usuarios;',
            'CREATE TABLE usuarios( 
                id   INT AUTO_INCREMENT,
                nombre VARCHAR(100), 
                rut INT,
                dv INT,
                PRIMARY KEY(id)
            );',
            'CREATE TABLE tipos( 
                id   INT AUTO_INCREMENT,
                nombre VARCHAR(100), 
                PRIMARY KEY(id)
            );',
            'CREATE TABLE archivos( 
                id   INT AUTO_INCREMENT,
                usuario_id  INT, 
                tipo_id INT, 
                PRIMARY KEY(id),
                FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
                FOREIGN KEY (tipo_id) REFERENCES tipos(id) 
            );'
        ];
        $conn = $this->conexion;
        foreach ($createTables as $table) {
            $conn->exec($table);
        }
        $insertTipos = ['Tipo 1', 'Tipo 2', 'Tipo 3'];
        $sqlInsert = "Insert into tipos(nombre) values(:nombre)";
        $statement = $conn->prepare($sqlInsert);
        foreach ($insertTipos as $tipo) {
            $statement->execute([
                ':nombre' => $tipo
            ]);
        }
    }

    public function obtenerTipos()
    {
        $conn = $this->conexion;
        $sql = "SELECT id, nombre from tipos";
        $resultado = $conn->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}