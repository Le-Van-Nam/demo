<?php
require_once 'models/User.php';
class UserController{
    public $content;
    public $error;
    public function render($file, $data = []) {
        extract($data);
        ob_start();
        require_once $file;
        $render_view = ob_get_clean();
        return $render_view;
    }
    public function register(){
      if(isset($_POST['register'])){
          $username=$_POST['username'];
          $password=$_POST['password'];
          if(empty($username)||empty($password)){
              $this->error="Username và password không được để trống";
          }
          if(empty($this->error)){
              $user_model=new User();
              $user_model->username=$username;
              $user_model->password=md5($password);
              $is_register=$user_model->register();
              if($is_register){
                  $_SESSION['success']="Register thành công";
                  header('Location:index.php?controller=user&action=login');
                  exit();
              }else{
                  $_SESSION['error']="Register thất bại";
              }
          }
      }

      $this->content=$this->render('views/users/register.php');
      require_once 'views/layouts/main_login.php';
    }
    public function login(){
        if(isset($_SESSION['user'])){
            header('Location: index.php?controller=category&action=index');
            exit();
        }
        if(isset($_POST['login'])){
            $username=$_POST['username'];
            $password=md5($_POST['password']);
            if(empty($username)||empty($password)){
                $this->error="Username và password không được để trống";
            }
            if(empty($this->error)){
                $model_login=new User();
                $user=$model_login->login($username,$password);
                if(!empty($user)){
                    $_SESSION['user']=$user;
                    $_SESSION['success']="Đăng nhập thành công";
                    header('Location:index.php?controller=category&action=index');
                    exit();
                }else{
                    $this->error="Sai tài khoản hoặc mật khẩu";
                }
            }
        }
     $this->content=$this->render('views/users/login.php');
     require_once 'views/layouts/main_login.php';
    }
    public function logout(){
        $_SESSION=[];
        $_SESSION['success']="Logout thành công";
        header('Location:index.php?controller=user&action=login');
        exit();

    }
}
?>