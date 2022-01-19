<?php

class EjercicioUno{

    private $conexion;

    public function __construct(){
        $this->conexion = require '../conexion.php';
    }

    public function obtenerEmpleadoSucursal(){
        //Funcion para obtener nombre de empleados y sucursal
        $conn = $this->conexion;
        $queryEmpleados = "SELECT empleados.nombre as empleado_nombre,
                            sucursales.nombre as sucursal_nombre
                            FROM empleados
        INNER JOIN sucursales ON empleados.sucursal_id = sucursales.id";
        
        $result = $conn->query($queryEmpleados);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            //Se puede recorrer arreglo con resultados del select
        }
        //Retorna arreglo con resultados
        return $result;
    }

    public function inactivarEmpleadosSucursalInactiva(){
        //Funcion para actualizar a inactivo todos los empleados cuya sucursal este inactiva
        $conn = $this->conexion;

        $queryUpdate = "UPDATE empleados 
        INNER JOIN sucursales ON empleados.sucursal_id = sucursales.id 
        SET empleados.activo = :activo 
        WHERE sucursales.activa = FALSE";

        $statement = $$conn->prepare($queryUpdate);
        $statement->bindParam(':activo', FALSE);
        if ($statement->execute()) {
	        //Se ejecuto correctamente el update
        }
    }
    public function obtenerEmpleadoZona($ano){
        //Obtener datos de empleados y nombre de la zona de las zonas creadas el año que recibe
        $conn = $this->conexion;

        $query = "SELECT empleados.*,
                                zonas.nombre as zona_nombre
                            FROM empleados
                                INNER JOIN sucursales ON empleados.sucursal_id = sucursales.id
                                INNER JOIN zonas ON sucursales.zona_id = zonas.id
                            WHERE zonas.created BETWEEN '2017-01-01 00:00:01' AND '2017-12-31 23:59:59'";

        $result = $conn->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            //Se puede recorrer arreglo con resultados del select
        }
        //Retorna arreglo con resultados
        return $result;
    }

}
