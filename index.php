<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$controller=isset($_GET['controller'])?$_GET['controller']:'category';
$action=isset($_GET['action'])?$_GET['action']:'index';
$controller=ucfirst($controller);
$controller.="Controller";
$controller_file=$controller.".php";
$path_controller="controllers/$controller_file";
if(!file_exists($path_controller)){
    die("Trang này không tồn tại");
}
require_once "$path_controller";
$object= new $controller();
if(!method_exists($object,$action)){
    die("Không tồn tại phương thức $action trong class $controller");
}
$object->$action();


?>