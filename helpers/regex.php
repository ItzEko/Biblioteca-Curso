<?php
//SECCION de respuesta del servidor
function jsonRespuesta($response, $code)
{
    header("HTTP/1.1" . $code); //concatenamos el codigo de respuesta del servidor
    header("Content-Type: application/json"); //le dice al navegador que es un objeto json
    echo json_encode($response); //la respuesta la convirtimos en json
    exit;
}

//SECCION  para limpiar las cadenas(previene inyecciones sql)
//Elimina exceso de espacios entre palabras
function strClean($strCadena)
{
    $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena);
    $string = trim($string); //Elimina espacios en blanco al inicio y al final
    $string = stripslashes($string); // Elimina las \ invertidas
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    return $string;
}
//SECCION de expresiones regulares
//regex para validar cadenas, acentos valores nulos, No acepta numeros y caracterres especiales
function tesGeneracion($data)
{
    $regex = '/^\d{4}-\d{4}$/';
    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}
function testString($data)
{
    $regex = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';
    if (preg_match($regex, $data)) {
        return true; //todo ok
    } else {
        return false;
    }
}
//acepta Espacios en blanco, cadenas, acentos, numeros y puntos, pero cualquier caracter especial NO
function testStrinNumPunto($data)
{
    $regex = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9. ]+$/';
    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}
function testClaveMateria($data)
{
    $regex = '/^[A-Z]{3}\-\d{4}/';
    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}

function testEnteros($data)
{
    $regex = '/^[0-9]+$/';
    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}
function testFecha($data)
{   //dd/mm/aaaa
    //$regex='/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/(19|20)\d{2}$/';
    //aaaa/mm/dd
    $regex = '/^\d{4}([\-\/.])(0?[1-9]|1[1-2])\1(3[01]|[12][0-9]|0?[1-9])$/';
    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}
function testCorreo($data)
{
    $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}
function testPss($data)
{
    $regex = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';

    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}
function testLetrasEspacio($data)
{
    $regex = '/[a-zA-ZáéíóúÁÉÍÓÚñÑ."]+(?: [a-zA-ZáéíóúÁÉÍÓÚñÑ."]+)*$/';

    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}
function testClaveEstudios($data)
{
    $regex = '/^[A-Z]{4}-\d{4}-\d{3}$/';

    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}
function testRfc($data)
{
    $regex = '/^([A-Z]{4})([0-9]{6})([A-Z0-9]{3})$/';
    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}
function testCurp($data)
{
    $regex = '/^[A-Z]{4}[0-9]{6}[H,M][A-Z]{5}[A-Z,0-9][0-9]$/';
    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}

function testMatriculaEstu($data)
{
    $regex = '/^\d{2}VC\d{4}$/i';
    if (preg_match($regex, $data)) {
        return true;
    } else {
        return false;
    }
}