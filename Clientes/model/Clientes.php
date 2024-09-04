<?php
require_once '../../helpers/regex.php';
require_once '../../libraries/MySql.php';

//hereda de MySql las funciones de insertar, seleccionar etc...
class Clientes extends MySql
{
    //propiedades de la tabla de la bd 
    private $Nombre;
    private $Apellido;
    private $Direccion;
    private $Ciudad;
    private $Estado;
    private $CP;
    private $ClienteID;

    //constructor hijo que es de la clase clientes 
    public function __construct($data)
    {
        //constructor padre que es de la clase MySql
        parent::__construct();
        //data almacena en array las propiedades de clientes 
        $this->Nombre = $data['data']['Nombre'] ?? ''; //en caso que no se encuentra la clave se almacene como cadena vacia
        $this->Apellido = $data['data']['Apellido'] ?? '';
        $this->Direccion = $data['data']['Direccion'] ?? '';
        $this->Ciudad = $data['data']['Ciudad'] ?? '';
        $this->Estado = $data['data']['Estado'] ?? '';
        $this->CP = $data['data']['CP'] ?? '';
        $this->ClienteID = $data['ClienteID'] ?? '';
    }

    public function guardar()
    {
        try {
            $sql = "INSERT INTO  clientes (Nombre, Apellido, Direccion, Ciudad, Estado, CP) 
            VALUES (:Nombre, :Apellido, :Direccion, :Ciudad, :Estado, :CP)";
            //se hace un arreglo para ingresar los datos 
            $valores = [
                ':Nombre' => $this->Nombre,
                ':Apellido' => $this->Apellido,
                ':Direccion' => $this->Direccion,
                ':Ciudad' => $this->Ciudad,
                ':Estado' => $this->Estado,
                ':CP' => $this->CP
            ];

            $resultado = $this->insert($sql, $valores);
            return $resultado;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function buscar()
    {
        try {
            $sql = "SELECT Nombre AS NombreCliente FROM clientes WHERE ClienteID = :ClienteID ";
            $valores = [
                ':ClienteID' => $this->ClienteID,
            ];
            $resultado = $this->select($sql, $valores);
            return $resultado;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function buscarTodos()
    {
        try {
            $sql = "SELECT ClienteID AS ID, Nombre AS NombreCliente, Apellido AS ApellidoCliente,
                Direccion AS DireccionCliente, Ciudad AS CiudadCliente, Estado AS EstadoCliente, CP AS CPCliente FROM 
                clientes ";
            $valores = [
                ':Nombre' => $this->Nombre,
                ':Apellido' => $this->Apellido,
                ':Direccion' => $this->Direccion,
                ':Ciudad' => $this->Ciudad,
                ':Estado' => $this->Estado,
                ':CP' => $this->CP,
                ':ClienteID' => $this->ClienteID,
            ];
            $resultado = $this->select_all($sql, $valores);
            return $resultado;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function borrar()
    {
        try {
            $sql = "DELETE FROM clientes WHERE ClienteID = :ClienteID";
            $valores = [
                ':ClienteID' => $this->ClienteID,
            ];
            $resultado = $this->delete($sql, $valores);
            return $resultado;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function actualizar()
    {
        try {
            $sql = "UPDATE clientes SET 
                Nombre = :Nombre, 
                Apellido = :Apellido, 
                Direccion = :Direccion, 
                Ciudad = :Ciudad, 
                Estado = :Estado, 
                CP = :CP 
                WHERE ClienteID = :ClienteID";
            $valores = [
                ':Nombre' => $this->Nombre,
                ':Apellido' => $this->Apellido,
                ':Direccion' => $this->Direccion,
                ':Ciudad' => $this->Ciudad,
                ':Estado' => $this->Estado,
                ':CP' => $this->CP,
                ':ClienteID' => $this->ClienteID,
            ];
            $resultado = $this->update($sql, $valores);
            return $resultado;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function validar($metodo)
    {
        $errores = 0;
        switch ($metodo) {
            case 'guardar':
                // "!" es negacion
                if (
                    !testString($this->Nombre)
                    && !testString($this->Apellido)
                    && !testLetrasEspacio($this->Direccion)
                    && !testLetrasEspacio($this->Ciudad)
                    && !testLetrasEspacio($this->Estado)
                    && !testEnteros($this->CP)
                ) {
                    $errores++;
                }
                break;
            case 'buscar':
                if (!testEnteros($this->ClienteID)) {
                    $errores++;
                }
                break;
            case 'borrar':
                if (!testEnteros($this->ClienteID)) {
                    $errores++;
                }
                break;
            case 'actualizar':
                if (
                    !testEnteros($this->ClienteID)
                    && !testString($this->Nombre)
                    && !testString($this->Apellido)
                    && !testLetrasEspacio($this->Direccion)
                    && !testLetrasEspacio($this->Ciudad)
                    && !testLetrasEspacio($this->Estado)
                    && !testEnteros($this->CP)
                ) {
                    $errores++;
                }
                break;
            default:
                $errores++;
                break;
        }
        //si no hay errores retorna cero y se pasa al controller
        return $errores;
    }
}
//codigo para testear metodos
// $data = ['Nombre'=>'Angel', 'Apellido'=>'Castillo', 'Direccion'=>'Calle 5','Ciudad'=>'Puebla',
// 'Estado'=>'Puebla', 'CP'=>'730'];
// $clientes = new Clientes($data);
// $resu= $clientes -> validar('guardar');
// print_r($resu);


//codigo para buscar el cliente
// $data = ['ClienteID'=> 4];
// $clientes = new Clientes($data);
// $resu = $clientes -> buscar();
// print_r($resu);

//BuscarTodos
// $data = [];
// $clientes = new Clientes($data);
// $resu = $clientes -> buscarTodos();
// print_r($resu);

//borrar
// $data = ['ClienteID'=>2];
// $clientes = new Clientes($data);
// $resu = $clientes -> borrar();
// print_r($resu);

//Actualizar 
// $data = [
//     'Nombre' => 'Teresa Itzel',
//     'Apellido' => 'Guzman Tellez',
//     'Direccion' => 'Calle 01',
//     'Ciudad' => 'Tlapacoyan',
//     'Estado' => 'Veracruz',
//     'CP' => 12345,
//     'ClienteID' => 4
// ];
// $clientes = new Clientes($data);
// $resu = $clientes->actualizar();
// print_r($resu);
