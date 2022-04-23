<?php
// クラスの読み込み
require_once "mydb.php";
class Display{
    // dbh：データベースハンドル用
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

    function __construct($page_index,$search_word,$sort_which){
        $this->page_index=$page_index;
        $this->search_word=$search_word;
        $this->sort_which=$sort_which;
    }

    protected function page_params_init(){
        $this->dbh->sql_execute();
        $this->item_sum=$this->dbh->get_sum();
        $this->page_item_max=5;
        $this->page_num=(int)ceil($this->item_sum/$this->page_item_max);
        $this->page_item_num=min($this->page_item_max,$this->item_sum-$this->page_item_max*($this->page_index-1));
    }

    protected function execute(){
        $sql=$this->dbh->get_sql().$this->add_sort();
        $data=array_merge($this->dbh->get_data(),[$this->page_item_max*($this->page_index-1),$this->page_item_num]);
        $data_types=$this->dbh->get_data_types()."ii";
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

class Index extends Display{
    function __construct($page_index,$search_word,$sort_which){
        parent::__construct($page_index,$search_word,$sort_which);
        $this->dbh=new MyDB_select("SELECT * FROM posts",[],"");
        parent::page_params_init();
        parent::execute();
    }
}

class Search extends Display{
    function __construct($page_index,$search_word,$sort_which){
        parent::__construct($page_index,$search_word,$sort_which);
        $this->dbh=new MyDB_select("SELECT * FROM posts WHERE title LIKE ?",[$this->search_word],"s");
        parent::page_params_init();
        parent::execute();
    }
}
?>