<?php

class EjercicioDos{

    private $conexion;

    public function __construct(){
        $this->conexion = require '../conexion.php';
    }

    private function valor_actual($nemo){
        //Se asume que retorna valor actual de una accion
        return $nemo;
    }

    public function accionesSeparadasPorAccionDeUsuario($usuario = 'juan@gmail.com'){
        //usuario por defecto el indicado en el problema
        $conn = $this->conexion;
        $queryEmpleados = "SELECT categorias.nombre as categoria_nombre,
                            categorias.capital as categoria_capital,
                            acciones.*
                            FROM acciones
        INNER JOIN categorias ON acciones.categoria_id = categorias.id
        INNER JOIN usuarios ON acciones.usuario_id = usuarios.id
        WHERE usuarios.email = '$usuario'";
        
        $result = $conn->query($queryEmpleados);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $final = array();
        foreach($result as $row){
            $accion = [
                'nemo' => $row['nemo'],
                'valor_actual' => $this->valor_actual($row['nemo']),
                'cantidad' => $row['cantidad'],
                'valor_compra' => $row['valor_compra'],
                'decimales' => $row['decimales']
            ];
            $final[$row['categoria_nombre']]['acciones'] = $accion;
            $final[$row['categoria_nombre']]['capital'] = $row['categoria_capital'];
            
        }
        //Retorna arreglo con resultados
        return $final;
    }

    public function tablaAccionesPorUsuario($usuario = 'juan@gmail.com'){
        //usuario por defecto el indicado en el problema

        $dataAcciones = $this->accionesSeparadasPorAccionDeUsuario($usuario);
        $html = "<table>
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Nemo</th>
                            <th>Precio de compra</th>
                            <th>Cantidad de compra</th>
                            <th>Monto de la compra</th>
                            <th>Valor actual nemo</th>
                            <th>Capital actual</th>
                            <th>Porcentaje de ganancia/perdida</th>
                        </tr>
                    </thead>
                    <tbody>";
        foreach($dataAcciones as $key => $categorias){
            $capital = $categorias['capital'];
            foreach($categorias['acciones'] as $accion){
                $nemo = $accion['nemo'];
                $valorActualNemo = $accion['valor_actual'];
                $precioCompra = $accion['valor_compra'];
                $cantidadCompra = $accion['cantidad'];
                $montoCompra = (int)$precioCompra*(int)$cantidadCompra;
                $porcentaje = ''; //No se con que datos calcular el porcentaje
                $html .= "<tr>
                        <td>$key</td>
                        <td>$nemo</td>
                        <td>$precioCompra</td>
                        <td>$cantidadCompra</td>
                        <td>$montoCompra</td>
                        <td>$valorActualNemo</td>
                        <td>$capital</td>
                        <td>$porcentaje</td>
                    </tr>";
            }
        }
        $html.="</tbody>
                </table>";
        return $html;
    }

    public function actualizaCapital(){
        $conn = $this->conexion;
        $usuarios= $this->obtenerUsuarios();
        $sql  = "UPDATE categorias SET capital=? WHERE usuario_id= ?";
        $statement = $conn->prepare($sql);
        foreach($usuarios as $usuario){
            $capital = ''; //valor que se le quiere dar a capital, no entiendo el calculo que hay que realizar
            $id = $usuario['id']; //En la tabla ejemplo no se ve un registro id pero se estima que deberia estar
            $statement->execute([$capital, $id]);
        }
    }

    public function obtenerUsuarios(){
        $conn = $this->conexion;
        $queryUsuarios = "SELECT *
                            FROM usuarios";
        $result = $conn->query($queryUsuarios);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

}