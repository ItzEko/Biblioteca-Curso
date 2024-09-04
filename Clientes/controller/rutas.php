<?php 
require_once'./ClientesController.php';

if (!empty($_POST['data'])) { //este verifica que el data no este vacio
    $data = $_POST['data']; //si no esta vacio se crea la varible data, que pasará como argumento al instanciar la clase del controlador
    json_encode($data);
    $clientesController = new ClientesController($data);
}else {
    header('Location: ../../');
}
?>