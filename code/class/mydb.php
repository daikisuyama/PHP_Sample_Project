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

    public function get_sql(){
        return $this->sql;
    }

    public function set_data($data){
        $this->data=$data;
    }

    public function get_data(){
        return $this->data;
    }

    public function set_data_types($data_types){
        $this->data_types=$data_types;
    }

    public function get_data_types(){
        return $this->data_types;
    }

    public function set_params($sql,$data,$data_types){
        $this->set_sql($sql);
        $this->set_data($data);
        $this->set_data_types($data_types);
    }

    function __destruct(){
        // データベースからの切断
        $this->mysqli->close();
    }
}

class MyDB_select extends MyDB{
    // 実行結果
    public mysqli_result $result;
    public function sql_execute(){
        parent::sql_execute();
        // バッファリングして結果を取得
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
    // 変更できていればtrue
    public function sql_execute(){
        parent::sql_execute();
        return $this->mysqli->affected_rows!==0;
    }
}

class MyDB_insert extends MyDB{
    // 挿入したToDoのidを返す
    public function sql_execute(){
        parent::sql_execute();
        return $this->mysqli->insert_id;
    }
}

class MyDB_delete extends MyDB{
    // 削除できていればtrue
    public function sql_execute(){
        parent::sql_execute();
        return $this->mysqli->affected_rows!==0;
    }
}