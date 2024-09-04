
<?php
require_once './UsuarioController.php';


if (!empty($_POST['accion'])) { //verifica que no éste vacio la accion
    $accion = $_POST['accion']; //accion pasa SwitchCase para iniciar el metodo
} else {
    header('Location: ../../');
}
//trae la info
if (!empty($_POST['data'])) { //este verifica que el data no este vacio
    $data = $_POST['data']; //si no esta vacio se crea la varible data, que pasará como argumento al instanciar la clase del controlador
}
switch ($accion) {
    case 'session':
        require_once './UsuarioController.php';
        $usuarioController = new UsuarioController($data);
        break;
    case 'restablecer':
        require_once './RestablecerContra.php';
        $usuarioController = new UsuarioController($data);
        break;
    default:
        # code...
        break;
}


?>


