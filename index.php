<?php
require_once("Config/Config.php");
// require_once("Helpers/Helpers.php");

$url = !empty($_GET['url']) ? $_GET['url'] : "home/home";
// separa un strim cuando encuentre el caracter, en este caso el /
$arrUrl = explode("/", $url);
// asignar controlador
$controller = $arrUrl[0];
// asignar metodo
$method = $arrUrl[0];
//definir parametros
$params = "";

if (!empty($arrUrl[1])) {
    if ($arrUrl[1] != "") {
        $method = $arrUrl[1];
    }
}

if (!empty($arrUrl[2])) {
    if ($arrUrl[2] != "") {
        for ($i = 2; $i < count($arrUrl); $i++) {
            // asignar parametros y concatenar la ,
            $params .= $arrUrl[$i] . ',';
        }
        // eliminar ultima ,
        $params = trim($params, ',');
    }
}


spl_autoload_register(function ($class) {
    if (file_exists("Libraries/" . 'Core/' . $class . ".php")) {
        require_once("Libraries/" . 'Core/' . $class . ".php");
    }
});



$controller = ucwords($controller);
$controllerFile = "Controllers/" . $controller . ".php";
if (file_exists($controllerFile)) {
    require_once($controllerFile);
    $controller = new $controller();
    if (method_exists($controller, $method)) {
        $controller->{$method}($params);
    } else {
        echo "no exite el metodo";
        // require_once("Controllers/Error.php");
    }
} else {
    echo "no exite el controlador";
    // require_once("Controllers/Error.php");
}
