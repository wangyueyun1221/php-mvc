<?php
function dd($params)
{
    echo "<pre>";
    var_dump($params);
    echo "</pre>";
    die;
}

function responseSuccess($data, $message = '')
{
    header('Content-type: application/json');
    echo json_encode([
        'status' => 'ok',
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

function responseError($message, $data = '')
{
    header('Content-type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

define('ROOT_DIR', dirname(__FILE__));

// index.php?controller=demo&action=show
$controller = isset($_GET['controller']) ? $_GET['controller'] : ''; // demo
$action = isset($_GET['action']) ? $_GET['action'] : ''; // show

if (!$controller) {
    dd('controller不可为空');
}
if (!$action) {
    dd('action不可为空');
}
$className = sprintf('%sController', $controller);
$action = sprintf('%sAction', $action);

$controllerPath = sprintf('%s/controller/%s.php', ROOT_DIR, $className);
if (!file_exists($controllerPath)) {
    dd('文件不存在');
}
require_once $controllerPath;
if (!class_exists($className)) {
    dd('类不存在');
}
$class = new $className();
if (!method_exists($class, $action)) {
    dd('方法不存在');
}
$class->$action();