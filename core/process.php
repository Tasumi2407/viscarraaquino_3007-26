<?php

$hosts_aceptados = array('localhost', '127.0.0.1', '192.168.165.3');
$metodo_aceptado = "POST";

$usuario_correcto = base64_encode(hash("sha1", "Admin"));
$password_correcto = base64_encode(hash("sha1", "Admin"));

$txt_usuario = isset($_POST["txt_usuario"]) ? $_POST["txt_usuario"] : null;
$txt_password = isset($_POST["txt_password"]) ? $_POST["txt_password"] : null;

$ruta = "";
$msg = "";
$codigo_estado = 0;
$texto_estado = "";
$token = "";

$host = explode(':', $_SERVER["HTTP_HOST"])[0];

if (in_array($host, $hosts_aceptados)) {

    if ($_SERVER["REQUEST_METHOD"] == $metodo_aceptado) {

        if (!empty($txt_usuario) && !empty($txt_password)) {

            if ($txt_usuario == $usuario_correcto) {

                if ($txt_password == $password_correcto) {

                    $ruta = "welcome.php";
                    $msg = "";
                    $codigo_estado = 200;
                    $texto_estado = "OK";
                    $token = base64_encode(date("Y-m-d H:i:s") . uniqid());

                } else {

                    $ruta = "";
                    $msg = "La contraseña es incorrecta";
                    $codigo_estado = 401;
                    $texto_estado = "Unauthorized";
                    $token = "";

                }

            } else {

                $ruta = "";
                $msg = "El usuario es incorrecto";
                $codigo_estado = 401;
                $texto_estado = "Unauthorized";
                $token = "";

            }

        } else {

            $ruta = "";
            $msg = "El usuario y la contraseña son obligatorios";
            $codigo_estado = 412;
            $texto_estado = "Precondition Failed";
            $token = "";

        }

    } else {

        $ruta = "";
        $msg = "El método HTTP no es permitido";
        $codigo_estado = 405;
        $texto_estado = "Method Not Allowed";
        $token = "";

    }

} else {

    $ruta = "";
    $msg = "La dirección IP no es permitida";
    $codigo_estado = 403;
    $texto_estado = "Forbidden";
    $token = "";

}

$arreglo_respuesta = array(
    "status" => ($codigo_estado == 200) ? "success" : "error",
    "error" => ($codigo_estado == 200) ? "" : array(
        "code" => $codigo_estado,
        "message" => $msg
    ),
    "data" => array(
        "url" => $ruta,
        "token" => $token
    ),
    "count" => 1
);

http_response_code($codigo_estado);
header("Content-Type: application/json; charset=UTF-8");

echo json_encode($arreglo_respuesta);

?>
