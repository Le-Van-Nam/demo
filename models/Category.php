<?php
require_once "models/Model.php";
class Category extends Model {
    public $id;
    public $name;
    public $description;
    public $avatar;
    public $created_at;

    public function insert(){
        $sql="INSERT INTO categories(name,description,avatar) VALUES(:name,:description,:avatar)";
        $obj_insert=$this->connection->prepare($sql);
        $arr=[
            ':name'=>$this->name,
            ':description'=>$this->description,
            ':avatar'=>$this->avatar
        ];
       return $obj_insert->execute($arr);
    }
    public function getAll($params=[]){
        $item_per_page=$params['limit'];
        $current_page=$params['page'];
        $offset=($current_page-1)*$item_per_page;
        $sql="SELECT * FROM categories limit $item_per_page offset $offset";
        $obj_sql=$this->connection->prepare($sql);
        $obj_sql->execute();
        $result=$obj_sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function countTotal(){
       $obj_sql=$this->connection->prepare("SELECT COUNT(id) FROM categories");
       $obj_sql->execute();
       return $obj_sql->fetchColumn();
    }
    public function delete($id){
     $sql_delete="DELETE FROM categories WHERE id=$id";
     $obj_delete=$this->connection->prepare($sql_delete);
     $is_delete=$obj_delete->execute();
     return $is_delete;
    }
    public function getOne($id){
        $sql_select_one="SELECT * FROM categories WHERE id=$id";
        $obj_select_one=$this->connection->prepare($sql_select_one);
        $obj_select_one->execute();
        $category=$obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $category;
    }
    public function update($id){
        $sql_update="UPDATE categories SET `name`=:name,`description`=:description,`avatar`=:avatar WHERE id=$id";
        $obj_update=$this->connection->prepare($sql_update);
        $arr=[
            ':name'=>$this->name,
            ':description'=>$this->description,
            ':avatar'=>$this->avatar,
        ];
        return $obj_update->execute($arr);
    }
}
?>