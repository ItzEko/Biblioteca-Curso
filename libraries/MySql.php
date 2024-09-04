<?php 
require_once 'Conexion.php';

class MySql extends Conexion{
    private $conexion;
    private $strquery;
    private $arrValues;

    public function __construct()
    {
        //instancia 
        parent::__construct();
    }

    protected function select_all(string $query)
    {
        try {
            $this->strquery = $query;
            $execute = $this->connect()->query($this->strquery);
            $request = $execute->fetchall(PDO::FETCH_ASSOC); //ARRAY clave valor
            $execute->closeCursor();
            return $request;
        } catch (Exception $e) {
            $response = "Error: " . $e->getMessage();
            return $response;
        }
    }
    //Busca un registro
    protected function select(string $query, array $arrValues)
    {
        try {
            $this->strquery = $query;
            $this->arrValues = $arrValues;
            $query = $this->connect()->prepare($this->strquery);
            $query->execute($this->arrValues);
            //fechtall lo hace en arreglo los objetos, puede guardar varios objetos dentro de el
            $request = $query->fetchall(PDO::FETCH_ASSOC); //ARRAY, lo cambiaron a fetch y lo volví a poner fetchall porque si no, no devolvia el array multidimensional
            $query->closeCursor();
            if (is_array($request)) {
                return $request;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $response = "Error: " . $e->getMessage();
            return $response;
        }
    }
    protected function insert(string $query, array $arrValues)
    {
        try {
            $this->strquery = $query;
            $this->arrValues = $arrValues;
            $insert = $this->connect()->prepare($this->strquery);
            $resInsert = $insert->execute($this->arrValues);
            $numFilasInsertada = $insert->rowCount();
            if ($numFilasInsertada) {
                $insert->closeCursor();
                //regresa un verdadero
                return true;
            } else {
                $insert->closeCursor();
                return false;
            }
        } catch (Exception $e) {
            //throw $th;
            $response = "Error: " . $e->getMessage();
            return $response;
        }
    }

    //La funcion insertLastID() devuelve el id de la ultima insercion que se hizo a la tabla
    protected function insertLastID(string $query, array $arrValues): int
    {
        try {
            $this->strquery = $query;
            $this->arrValues = $arrValues;
            // Establecer la conexión y almacenarla en una variable
            $connection = $this->connect();
            $insert = $connection->prepare($this->strquery);
            $resInsert = $insert->execute($this->arrValues);
            $insert->closeCursor();
            $idInsert = intval($connection->lastInsertId());  // Obtener el último ID de la misma conexión
            if (is_numeric($idInsert)) {
                return $idInsert;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $response = "Error: " . $e->getMessage();
        }
    }

    protected function update(string $query, array $arrValues)
    {
        try {
            $this->strquery = $query;
            $this->arrValues = $arrValues;
            $update = $this->connect()->prepare($this->strquery);
            $resUpdate = $update->execute($this->arrValues);
            $numFilasActualizadas = $update->rowCount();
            if ($numFilasActualizadas) {
                $update->closeCursor();
                return true;
            } else {
                $update->closeCursor();
                return false;
            }
        } catch (Exception $e) {
            $response = "Error: " . $e->getMessage();
            return $response;
        }
    }

    protected function delete(string $query, array $arrValues)
    {
        try {
            $this->strquery = $query;
            $this->arrValues = $arrValues;
            $delete = $this->connect()->prepare($this->strquery);
            $resDelete = $delete->execute($this->arrValues);
            $delete->closeCursor();
            return $resDelete;
        } catch (Exception $e) {
            $response = "Error al aliminar el horario seleccionado: " . $e->getMessage();
            return $response;
        }
    }
}



?>