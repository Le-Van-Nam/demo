<?php
require_once "Controller.php";
require_once "models/Category.php";
require_once 'models/Pagination.php';
class CategoryController extends Controller {

public function index(){
    $model= new Category();
    $params=[
        'limit'=>2,
        'controller'=>'category',
        'action'=>'index'
    ];
   $page=1;
   if(isset($_GET['page'])){
       $page=$_GET['page'];
   }

    $count_total=$model->countTotal();
    $params['total']=$count_total;
    $params['page']=$page;

    $pagination= new Pagination($params);
    $pages=$pagination -> getPagination();

    $category=$model->getAll($params);
    $this->content=$this->render('views/categories/index.php',[
        'category'=>$category,
         'pages'=>$pages
    ]);
    require_once 'views/layouts/main.php';

}
public function create(){
      if(isset($_POST['submit'])){
          $name=$_POST['name'];
          $description=$_POST['description'];
          $avatar=$_FILES['avatar'];
          if(empty($name)){
              $this->error="Name không được để trống";
          }elseif(empty($description)){
              $this->error="Description ko đc để trống";
          }elseif($avatar['error']==0){
              $extension=strtolower(pathinfo($avatar['name'],PATHINFO_EXTENSION));
              $extension_allowed=['jpg','png','gif','jpeg'];
              $avatar_size=round($avatar['size']/1024/1024,2);
              if(!in_array($extension,$extension_allowed)){
                  $this->error="Ảnh không đúng định dạng";
              }elseif($avatar_size >2){
                  $this->error="Ảnh ko vượt quá 2 MB";
              }
              if(empty($this->error)){
                  if($avatar['error']==0){
                      $dir_upload=__DIR__."/../assets/upload";
                      if(!file_exists($dir_upload)){
                          mkdir($dir_upload);
                      }
                      $avatar_name=time().'-'.$avatar['name'];
                      move_uploaded_file($avatar['tmp_name'],$dir_upload.'/'.$avatar_name);
                  }
                  $model= new Category();
                  $model->name=$name;
                  $model->description=$description;
                  $model->avatar=$avatar_name;
                  $is_insert=$model->insert();
                  if($is_insert){
                      $_SESSION['success']="Insert thành công";
                  }else{
                      $_SESSION['error']="Insert thất bại";
                  }
                  header('location:index.php?controller=category&action=index');
                  exit();
              }
          }
      }
      $this->content=$this->render('views/categories/create.php');
      require_once 'views/layouts/main.php';
}
public function update(){
    if(!isset($_GET['id'])||!is_numeric($_GET['id'])){
        $_SESSION['error']="ID không hợp lệ";
        header('Location:index.php?controller=category&action=index');
        exit();
    }
    $id=$_GET['id'];
    $category_model= new Category();
    $category=$category_model->getOne($id);
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $description=$_POST['description'];
        $avatar=$_FILES['avatar'];
        if(empty($name)){
        $this->error="Name không được để trống";
        }elseif (empty($description)){
            $this->error="Description không được để trống";
        }elseif($avatar['error']==0){
            $extension=strtolower(pathinfo($avatar['name'],PATHINFO_EXTENSION));
            $extension_allowed=['jpg','png','gif','jpeg'];
            $avatar_size=round($avatar['size']/1024/1024,2);
            if(!in_array($extension,$extension_allowed)){
                $this->error="Ảnh không đúng định dạng";
            }elseif($avatar_size >2){
                $this->error="Ảnh ko vượt quá 2 MB";
            }
        }
        if(empty($this->error)){
            $avatar_name=$category['avatar'];
            if($avatar['error']==0){
                $dir_upload=__DIR__."/../assets/upload";
                @unlink($dir_upload.'/'.$avatar_name);
                $avatar_name=time().'-'.$avatar['name'];
                move_uploaded_file($avatar['tmp_name'],$dir_upload.'/'.$avatar_name);
            }
            $model= new Category();
            $model->name=$name;
            $model->description=$description;
            $model->avatar=$avatar_name;
            $is_update=$model->update($id);
            if($is_update){
                $_SESSION['success']="Update thành công";
                header('Location:index.php?controller=category&action=index');
                exit();
            }else{
                $_SESSION['error']="Update thất bại";
            }
        }
    }
    $this->content=$this->render('views/categories/update.php',['category'=>$category]);
    require_once 'views/layouts/main.php';

}
   public function detail(){
      if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
          $_SESSION['error']="ID không hợp lệ";
          header('Location:index.php?controller=category&action=index');
          exit();
      }
      $id=$_GET['id'];
      $category_model= new Category();
      $category=$category_model->getOne($id);
      $this->content=$this->render('views/categories/detail.php',
          ['category'=>$category]);
      require_once 'views/layouts/main.php';
   }
   public function delete(){
    if(!isset($_GET['id'])|| !is_numeric($_GET['id'])){
        $_SESSION['error']="ID không hợp lệ";
        header('Location:index.php?controller=category&action=index');
        exit();
    }
    $id=$_GET['id'];
    $category_model= new Category();
    $is_delete=$category_model->delete($id);
    $is_delete?$_SESSION['success']="Xóa thành công":$_SESSION['error']="Xóa thất bại";
    header('Location:index.php?controller=category&action=index');
    exit();
   }
}

?>