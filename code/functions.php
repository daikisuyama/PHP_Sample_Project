<?php
// データベースへの接続
function db_access(){
    // データベースへの接続
    $dsn="mysql:dbname=sample_project;host=localhost;charset=utf8";
    $user="root";
    $password="";
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

// ページング機能
// page_index：何ページ目か
// page_num：合計で何ページか
// url_param：クエリパラメータを連想配列で

// urlparamについて（色々直さないとあかん）
class Paging{
    private $page_index,$page_num,$url_param;

    function __construct($page_index,$page_num,$url_param){
        $this->page_index=$page_index;
        $this->page_num=$page_num;
        $this->url_param=$url_param;
    }

    public function create_paging(){
        if($this->page_num<=6){
            $this->create_paging_minimum();
        }elseif($this->page_index<=3){
            $this->create_paging_left();
        }elseif(($this->page_index)>=($this->page_num-2)){
            $this->create_paging_right();
        }else{
            $this->create_paging_maximum();
        }
    }

    private function create_paging_minimum(){
        for($i=1;$i<=$this->page_num;++$i){
            if($this->page_index==$i){
                print '<div class="paging_item_now">';
            }else{
                print '<div class="paging_item">';
            }
            $this->url_param["page"]=$i;
            print "<a href='index.php?".http_build_query($this->url_param)."'>{$i}</a>";
            print '</div>';
        }
    }

    private function create_paging_left(){
        for($i=1;$i<=$this->page_index+1;++$i){
            if($this->page_index==$i){
                print '<div class="paging_item_now">';
            }else{
                print '<div class="paging_item">';
            }
            $this->url_param["page"]=$i;
            print "<a href='index.php?".http_build_query($this->url_param)."'>{$i}</a>";
            print '</div>';
        }
        print '<div class="paging_item">';
        print "…";
        print '</div>';
        print '<div class="paging_item">';
        $this->url_param["page"]=$this->page_num;
        print "<a href='index.php?".http_build_query($this->url_param)."'>{$this->page_num}</a>";
        print '</div>';
    }

    private function create_paging_right(){
        print '<div class="paging_item">';
        $this->url_param["page"]=1;
        print "<a href='index.php?".http_build_query($this->url_param)."'>1</a>";
        print '</div>';
        print '<div class="paging_item">';
        print "…";
        print '</div>';
        for($i=$this->page_index-1;$i<=$this->page_num;++$i){
            if($this->page_index==$i){
                print '<div class="paging_item_now">';
            }else{
                print '<div class="paging_item">';
            }
            $this->url_param["page"]=$i;
            print "<a href='index.php?".http_build_query($this->url_param)."'>{$i}</a>";
            print '</div>';
        }
    }

    private function create_paging_maximum(){
        print '<div class="paging_item">';
        $this->url_param["page"]=1;
        print "<a href='index.php?".http_build_query($this->url_param)."'>1</a>";
        print '</div>';
        print '<div class="paging_item">';
        print "…";
        print '</div>';
        for($i=$this->page_index-1;$i<=$this->page_index+1;++$i){
            if($this->page_index==$i){
                print '<div class="paging_item_now">';
            }else{
                print '<div class="paging_item">';
            }
            $this->url_param["page"]=$i;
            print "<a href='index.php?".http_build_query($this->url_param)."'>{$i}</a>";
            print '</div>';
        }
        print '<div class="paging_item">';
        print "…";
        print '</div>';
        print '<div class="paging_item">';
        $this->url_param["page"]=$this->page_num;
        print "<a href='index.php?".http_build_query($this->url_param)."'>{$this->page_num}</a>";
        print '</div>';
    }
}
?>
