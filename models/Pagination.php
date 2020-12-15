<?php
class Pagination{
  public $params=[
      'limit',
      'total',
      'controller'=>'',
      'action'=>''
      ];
  public function __construct($abc)
  {
     $this->params=$abc;
  }
    public function getTotalPage(){
        $totalPage=ceil($this->params['total']/$this->params['limit']);
        return $totalPage;
    }

   //lấy trang hiện tại
     public function getCurrentPage(){
      $pages=1;
      if(isset($_GET['page'])){
          $pages=$_GET['page'];
      }
      return $pages;
     }
     //get first page
     public function getFirstPage(){
      $first='';
         $controller = $this->params['controller'];
         $action = $this->params['action'];
         $current_page=$this->getCurrentPage();
         if($current_page>=3){
          $first="<a class='first' href='index.php?controller=$controller&action=$action&page=1'>First</a>";
         }
         return $first;

     }
     //get last page
    public function getLastPage(){
        $last='';
        $controller = $this->params['controller'];
        $action = $this->params['action'];
        $current_page=$this->getCurrentPage();
        $total_page = $this->getTotalPage();
        if($current_page <= $total_page-2){
            $last="<a class='first' href='index.php?controller=$controller&action=$action&page=$total_page'>Last</a>";
        }
        return $last;

    }
    //get prev page
    public function getPrevPage(){
      $prev_page='';
      $controller=$this->params['controller'];
      $action=$this->params['action'];
      $current_page=$this->getCurrentPage();
      if($current_page>1){
          $prev=$current_page-1;
          $prev_page="<a class='first' href='index.php?controller=$controller&action=$action&page=$prev'>Prev</a>";
      }
      return $prev_page;
    }
    //get next page
    public function getNextPage(){
        $next_page='';
        $controller=$this->params['controller'];
        $action=$this->params['action'];
        $current_page=$this->getCurrentPage();
        $total_page = $this->getTotalPage();
        if($current_page <$total_page){
            $next=$current_page+1;
            $next_page="<a class='first' href='index.php?controller=$controller&action=$action&page=$next'>Next</a>";
        }
        return $next_page;
    }
    public function getPagination()
    {
        $show_page = '';
        $total_page = $this->getTotalPage();
        $controller = $this->params['controller'];
        $action = $this->params['action'];
        $current_page=$this->getCurrentPage();
        if ($total_page == 1) {
            return '';
        }
        //prev page
        $prevPage=$this->getPrevPage();
        $show_page.=$prevPage;
        //first page
        $firstPage=$this->getFirstPage();
        $show_page.=$firstPage;
        for ($page = 1; $page <= $total_page; $page++) {
            if ($page != $current_page) {
                if($page>$current_page - 2 && $page<$current_page + 2) {
                    $show_page .= "<a class='page' href='index.php?controller=$controller&action=$action&page=$page'>$page</a>";
                }
        }else{
                $show_page .= "<a class='page page_item'>$page</a>";
            }
        }
        //last page
        $lastPage= $this->getLastPage();
        $show_page.=$lastPage;
        //prev page
        $nextPage=$this->getNextPage();
        $show_page.=$nextPage;
        return $show_page;
    }
}
?>