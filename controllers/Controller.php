<?php
class Controller{
    public function __construct()
    {
        if(!isset($_SESSION['user'])&& $_GET['controller'] != 'user'){
            $_SESSION['error'] ="Bạn cần đăng nhập";
            header('location:index.php?controller=user&action=login');
            exit();
        }
    }
    public $error;
    public $content;

    public function render($file,$data=[]){
        extract($data);
        ob_start();
        require_once"$file";
        $render_view = ob_get_clean();
        return $render_view;
    }
}
?>