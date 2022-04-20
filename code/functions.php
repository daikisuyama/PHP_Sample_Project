<?php

// https://www.php.net/manual/ja/language.oop5.inheritance.php
class MyDB{
    // mysqliオブジェクト
    protected mysqli $mysqli;
    // SQL文
    protected string $sql;
    // SQL文に渡すデータ
    protected array $data;
    // SQL文に渡すデータの型
    protected string $data_types;
    // ステートメント
    protected mysqli_stmt $stmt;

    function __construct($sql,$data,$data_types){
        // データベースへの接続
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->mysqli=@new mysqli("localhost", "root", "", "sample_project");
        if ($this->mysqli->connect_error) {
            error_log('Connection error: '.$this->mysqli->connect_error);
            exit();
        }else{
            $this->mysqli->set_charset("utf8mb4");
            $this->sql=$sql;
            $this->data=$data;
            $this->data_types=$data_types;
        }
    }

    // SQL文の実行
    public function sql_execute(){
        $this->stmt=($this->mysqli)->prepare($this->sql);
        if(count($this->data)!==0){
            // bindで型を指定してやる
            $this->stmt->bind_param($this->data_types,...$this->data);
        }
        $this->stmt->execute();
    }

    public function set_sql($sql){
        $this->sql=$sql;
    }

    public function set_data($data){
        $this->data=$data;
    }

    public function set_data_types($data_types){
        $this->data_types=$data_types;
    }

    function __destruct(){
        // データベースからの切断
        $this->mysqli->close();
    }
}

class MyDB_insert extends MyDB{
    public function insert_id(){
        return $this->mysqli->insert_id;
    }
}

class MyDB_select extends MyDB{
    // 実行結果
    public mysqli_result $result;
    public function sql_execute(){
        parent::sql_execute();
        $this->result=$this->stmt->get_result();
    }
    
    // レコードの取得
    public function get_record(){
        return $this->result->fetch_assoc();
    }
    // 全数の取得（直前でsql_execute()を行なっている場合）
    public function get_sum(){
        return $this->result->num_rows;
    }
}

class MyDB_update extends MyDB{

}

class MyDB_delete extends MyDB{
    // 削除できていればtrue
    public function sql_execute(){
        parent::sql_execute();
        return $this->mysqli->affected_rows!==0;
    }
}




// ページング機能
class Paging{
    // page_index：index.phpの何ページ目にいるか
    // page_num：index.phpのページ数
    // url_params：今いるページのクエリパラメータ
    private int $page_index,$page_num;
    private array $url_params;

    function __construct($page_index,$page_num,$url_params){
        $this->page_index=$page_index;
        $this->page_num=$page_num;
        $this->url_params=$url_params;
    }

    // 3点ドットの作成
    private function create_ellipsis(){
        print "<div class='paging_item'>…</div>";
    }

    // 最初のページの作成
    private function create_first(){
        $this->create_between(1,1);
    }

    // 最後のページの作成
    private function create_last(){
        $this->create_between($this->page_num,$this->page_num);
    }

    // 間のページの作成
    // 今いるページが含まれる場合、そのページのclass名を変更
    private function create_between($begin,$end){
        for($i=$begin;$i<=$end;++$i){
            $class_name=$this->page_index==$i ? "'paging_item_now'" : "'paging_item'";
            print "<div class={$class_name}>";
            $this->url_params["page"]=$i;
            print "<a href='index.php?".http_build_query($this->url_params)."'>{$i}</a>";
            print "</div>";
        }
        // 元に戻す
        $this->url_params["page"]=$this->page_index;
    }

    private function create_paging_minimum(){
        $this->create_between(1,$this->page_num);
    }

    private function create_paging_left(){
        $this->create_between(1,$this->page_index+1);
        $this->create_ellipsis();
        $this->create_last();
    }

    private function create_paging_right(){
        $this->create_first();
        $this->create_ellipsis();
        $this->create_between($this->page_index-1,$this->page_num);
    }

    private function create_paging_maximum(){
        $this->create_first();
        $this->create_ellipsis();
        $this->create_between($this->page_index-1,$this->page_index+1);
        $this->create_ellipsis();
        $this->create_last();
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
}
?>