<?php
require_once "configs/Database.php";
class Model{
    protected $connection;

    public function __construct()
    {
        $this->connection=$this->getConnection();
    }
    public function getConnection(){
        try{
            $connection= new PDO(Database::DB_DSN,Database::DB_USERNAME,Database::DB_PASSWORD);
        }catch (PDOException $e){
            die("Lỗi kết nối".$e->getMessage());
        }
        return $connection;
    }

}
?>