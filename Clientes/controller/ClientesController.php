<?php
require_once '../../helpers/regex.php';
require_once '../model/Clientes.php';

class ClientesController extends Clientes
{
    //almacena el metodo que se va a realizar guardar, buscar, eliminar, etc... 
    private $metodo;

    public function __construct($data)
    {
        parent::__construct($data);
        //acceder al arreglo 
        $this->metodo = $data['metodo'];
        $this->metodos();
    }
    private function metodos()
    {
        switch ($this->metodo) {
            case 'guardar':
                $this->setCliente();
                break;
            case 'buscar':
                $this->getCliente();
                break;
            case 'buscarTodos':
                    $this->getClienteAll();
                    break;
            case 'borrar':
                $this->deleteCliente();
                break;
            case 'actualizar':
                $this->updateCliente();
                break;
            default:
                # code...
                break;
        }
    }


    private function setCliente()
    {
        try {
            $validar = $this->validar($this->metodo);
            if ($validar === 0) {
                $request = $this->guardar();
                if ($request === true) {
                    $response = ['status' => true, 'msg' => 'Cliente guardado con exito'];
                    $code = 200;
                } else {
                    $response = ['status' => false, 'msg' => 'Cliente no ha sido registrado'];
                    $code = 200;
                }
            } else {
                $response = ['status' => false, 'msg' => 'No es valido los valores ingresados'];
                $code = 200;
            }

            return jsonRespuesta($response, $code);
        } catch (Exception $e) {
            $response = ['Status' => false, 'error al registrar un cliente' => $e->getMessage()];
            $code = 500;
            return jsonRespuesta($response, $code);
        }
    }
    private function getCliente()
    {
        try {
            $validar = $this->validar($this->metodo);
            $request = $this->buscar();
            if ($validar === 0) {
                //verifica si es un arreglo, si lo es, es true si no, es false
                if (is_array($request)) {
                    $response = ['status' => true, 'msg' => 'Cliente encontrado', 'data' => $request];
                    $code = 200;
                } else {
                    $response = ['status' => false, 'msg' => 'Cliente no ha sido encontrado'];
                    $code = 200;
                }
            } else {
                $response = ['status' => false, 'msg' => 'La informacion requerida no existe'];
                $code = 200;
            }
            return jsonRespuesta($response, $code);
        } catch (Exception $e) {
            $response = ['Status' => false, 'error al encontrar un cliente' => $e->getMessage()];
            $code = 500;
            return jsonRespuesta($response, $code);
        }
    }
    private function getClienteAll()
    {
        try {
            $request = $this->buscarTodos();
                //verifica si es un arreglo, si lo es, es true si no, es false
                if (is_array($request)) {
                    $response = ['status' => true, 'msg' => 'Todos los clientes han sido encontrados', 'data' => $request];
                    $code = 200;
                } else {
                    $response = ['status' => false, 'msg' => 'No se han encontrado clientes'];
                    $code = 200;
                }
            return jsonRespuesta($response, $code);
        } catch (Exception $e) {
            $response = ['Status' => false, 'error al encontrar todos cliente' => $e->getMessage()];
            $code = 500;
            return jsonRespuesta($response, $code);
        }
    }
    private function deleteCliente()
    {
        try {
            $validar = $this->validar($this->metodo);
            $request = $this->borrar();
            if ($validar === 0) {
                //verifica si es un arreglo, si lo es, es true si no, es false
                if ($request === true) {
                    $response = ['status' => true, 'msg' => 'Cliente Eliminado', 'data' => $request];
                    $code = 200;
                } else {
                    $response = ['status' => false, 'msg' => 'Cliente no ha sido Eliminado'];
                    $code = 200;
                }
            } else {
                $response = ['status' => false, 'msg' => 'No existe Cliente'];
                $code = 200;
            }
            return jsonRespuesta($response, $code);
        } catch (Exception $e) {
            $response = ['Status' => false, 'error al borrar un cliente' => $e->getMessage()];
            $code = 500;
            return jsonRespuesta($response, $code);
        }
    }
    private function updateCliente()
    {
        try {
            $validar = $this->validar($this->metodo);
            $request = $this->actualizar();
            if ($validar === 0) {
                if ($request === true) {
                    $response = ['status' => true, 'msg' => 'Cliente actualizado con exito', 'data' => $request];
                    $code = 200;
                } else {
                    $response = ['status' => false, 'msg' => 'Cliente no ha sido actualizado'];
                    $code = 200;
                }
            }else {
                $response = ['status' => false, 'msg' => 'No existe Cliente'];
                $code = 200;
            }

            return jsonRespuesta($response, $code);
        } catch (Exception $e) {
            $response = ['Status' => false, 'error al actualizar un cliente' => $e->getMessage()];
            $code = 500;
            return jsonRespuesta($response, $code);
        }
    }
}
//GUARDAR
// $data = ['metodo' => 'guardar', 'Nombre' => '', 'Apellido' => 'Herrera', 'Direccion' => 'Carolina North', 'Ciudad' => 'New York', 'Estado' => 'Estados Unidos', 'CP' => 00002];
// $clientesController = new ClientesController($data);
// print_r($clientesController);

//BUSCAR
// $data = ['metodo' => 'buscar', 'ClienteID' => 1];
// $clientesController = new ClientesController($data);
// print_r($clientesController);

//BUSCAR TODOS
// $data = ['metodo' => 'buscarTodos'];
// $clientesController = new ClientesController($data);
// print_r($clientesController);

//ELIMINAR
// $data = ['metodo' => 'borrar', 'ClienteID' =>6];
// $clientesController = new ClientesController($data);
// print_r($clientesController);

//ACTUALIZAR
// $data = ['metodo' =>'actualizar', 'Nombre'=>'Carol ', 'Apellido'=>'Herrera', 'Direccion'=>'calle','Ciudad'=>'Hollywood','Estado'=>'EU', 'CP'=>'00000','ClienteID' =>5];
// $clientesController = new ClientesController($data);
// print_r($clientesController);