<?php
// クラスの読み込み
require_once "mydb.php";
class Display{
    protected MyDB_select $dbh;
    // page_item_max:それぞれのページに表示する最大件数
    // page_num：合計のページ数
    // page_item_num：今のページに実際に表示する件数
    // item_sum：合計のitem数
    protected int $page_item_max,$page_num,$page_item_num,$item_sum;
    // page_index:今いるページ
    protected int $page_index;
    // search_word：検索ワード、null許容
    protected $search_word;
    // sort_which：ソート順
    protected string $sort_which;
    // sql_params：順にsql,data,datatypes
    protected array $sql_params;

    // search_params：順に$page_index,$search_word,$sort_which
    function __construct($url_params,$sql_params){
        list($this->page_index,$this->search_word,$this->sort_which)=$url_params;
        $this->sql_params=$sql_params;
        $this->page_params_init();
        $this->execute();
    }

    protected function page_params_init(){
        $this->dbh=new MyDB_select(...$this->sql_params);
        $this->dbh->sql_execute();
        $this->item_sum=$this->dbh->get_sum();
        $this->page_item_max=5;
        $this->page_num=(int)ceil($this->item_sum/$this->page_item_max);
        $this->page_item_num=min($this->page_item_max,$this->item_sum-$this->page_item_max*($this->page_index-1));
    }

    protected function execute(){
        $sql=$this->sql_params[0].$this->add_sort();
        $data=array_merge($this->sql_params[1],[$this->page_item_max*($this->page_index-1),$this->page_item_num]);
        $data_types=$this->sql_params[2]."ii";
        $this->dbh->set_params($sql,$data,$data_types);
        $this->dbh->sql_execute();
    }

    protected function add_sort(){
        $sql_order=" ORDER BY {$this->sort_which} ";
        $sql_order.= $this->sort_which==="title" ? "asc": "desc";
        $sql_order.=", id desc LIMIT ?,?";
        return $sql_order;
    }

    // ToDoの情報を取得（True or False）
    public function get_record(){
        return $this->dbh->get_record();
    }

    public function get_page_index(){
        return $this->page_index;
    }
    public function get_search_word(){
        return $this->search_word;
    }
    public function get_sort_which(){
        return $this->sort_which;
    }
    public function get_page_num(){
        return $this->page_num;
    }
}

// view.php
// 一つのToDoを表示
class View{
    private MyDB_select $dbh;
    function __construct($id){
        $this->execute($id);
    }

    // SQL文の実行
    private function execute($id){
        $sql="SELECT * FROM posts WHERE id=?";
        $this->dbh=new MyDB_select($sql,[$id],"i");
        $this->dbh->sql_execute();
    }

    // ToDoの情報を取得（True or False）
    public function get_record(){
        return $this->dbh->get_record();
    }
}
?>