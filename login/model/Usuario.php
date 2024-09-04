<?php
require_once '../../libraries/MySql.php';
require_once'../../helpers/regex.php';

class Usuario extends MySql
{
    //se ponen privados los datos ya que no deben de salir
    private $Correo;
    private $Contrasena;
    //el constructor inicializa los objetos 
    public function __construct($data)
    {
        //heredar el constructor de otra clase
        parent::__construct();
        //asignan valores a las propiedades correo y contraseña, donde data accede al valor
        $this->Correo = $data['Correo'];
        $this->Contrasena = $data['Contraseña'];
    }

    public function verificar()
    {
        try {
            //se utilizan los : en vez de valores especificos para evitar inyeccciones SQL 
            $sql = "SELECT * FROM administrador WHERE Correo = :Correo AND Contraseña = :Contrasena";
            $valores = [
                //asignacion de valores
                'Correo' => $this->Correo,
                'Contrasena' => $this->Contrasena
            ];
            //se llama la funcion select de MySql y se le ponen los parametros que recibe
            $resultado = $this->select($sql, $valores);
            //retorna un array
            return $resultado;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //checar si la funcion validar esta pueda estar en regex o en un archivo a parte de controlador y se mande a llamar
    //funcion para validar los datos esten correctos al momento de iniciar sesion
    protected function validar($metodo)
    {
        //inicializa los errores en cero
        $errores = 0;
        //metodo es la variable que trae que se va a hacer 
        switch ($metodo) {
            case 'login':
                //valida que el correo sea el correcto, testString devuelve un True
                if (!testCorreo($this->Correo)&& !testPss($this->Contrasena))
                {//this->correo para acceder a las propiedades
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

// $data = ['Correo'=> 'itzel@gmail.com', 'Contraseña'=> 123456];
// $Usuario = new Usuario($data);
// $resu = $Usuario->verificar();
// print_r($resu);
