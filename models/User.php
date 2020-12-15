<?php
require_once 'models/Model.php';
class User extends Model {
public $id;
Public $username;
public $password;
public function register(){
  $sql_insert="INSERT INTO users(username,password) VALUES(:username,:password)";
  $obj_insert=$this->connection->prepare($sql_insert);
  $arr=[
      ':username'=>$this->username,
      ':password'=>$this->password,
  ];
  return $obj_insert->execute($arr);
}
public function login($username,$password){
 $sql_login="SELECT * FROM users WHERE username=:username AND password=:password";
 $obj_login=$this->connection->prepare($sql_login);
 $arr=[
     ':username'=>$username,
     ':password'=>$password,
 ];
 $obj_login->execute($arr);
$user=$obj_login->fetch(PDO::FETCH_ASSOC);
return $user;
}
}
?>