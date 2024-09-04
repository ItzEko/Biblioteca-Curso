<?php
require_once '../model/Usuario.php';

class UsuarioController extends Usuario
{
    private $metodo;
    public function __construct($data)
    {
        parent::__construct($data);
        //acceder al arreglo 
        $this->metodo = $data['metodo'];
        $this->metodos();
    }
    public function metodos()
    {
        switch ($this->metodo) {
            case 'login':
                $this->getUsuario();
                break;
            default:
                # code...
                break;
        }
    }
    public function getUsuario()
    {
        try {
            //validar almacena la funcion que viene del modelo y pasa como parametro a metodo
            $validar = $this->validar($this->metodo);
            //se verifica si el resultado de la validacion de la funcion es igual a 0, resultado de la negacion en el model
            if ($validar === 0) {
                //si se cumple se pasa al metodo de verificar los datos
                $request = $this->verificar();
                //si es un arreglo y esta vacio es que no existe, para eso sirve el denegar el empty
                if (is_array($request) && !empty($request)) {
                    $response = ['status' => true, 'msg' => 'Usuario ha sido encontrado', 'data' => $request];
                    $code = 200;
                } else {
                    $response = ['status' => false, 'msg' => 'Usuario no ha sido encontrado'];
                    $code = 200;
                }
            }else{
                $response = ['status' => false, 'msg' => 'Verifica tu correo'];
                $code = 200;
            }

            return jsonRespuesta($response, $code);
        } catch (Exception $e) {
            $response = ['Status' => false, 'error al encontrar un cliente' => $e->getMessage()];
            $code = 500;
            return jsonRespuesta($response, $code);
        }
    }
}
$data = ['metodo' => 'login', 'Correo' => 'itzel@gmail.com', 'Contraseña' => 123456];
$UsuarioController = new UsuarioController($data);
print_r($UsuarioController);
