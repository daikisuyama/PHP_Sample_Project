<!-- viewとcreateをまとめる？ -->
<?php
require_once "mydb.php";
class Todo{
    function __construct($data){
        $this->execute($data);
    }
    protected function execute($data){
    }
}
// view.php
// 一つのToDoを表示
class View extends ToDo{
    protected MyDB_select $dbh;

    // SQL文の実行
    // data（id）
    public function execute($data){
        parent::execute($data);
        $sql="SELECT * FROM posts WHERE id=?";
        $this->dbh=new MyDB_select($sql,$data,"i");
        $this->dbh->sql_execute();
    }

    // ToDoの情報を取得（True or False）
    public function get_record(){
        return $this->dbh->get_record();
    }
}

class Edit extends ToDo{
    protected MyDB_update $dbh;
    private $is_edit;

    // SQL文の実行
    // data（title,content,updated_at,id）
    public function execute($data){
        parent::execute($data);
        $sql="UPDATE posts SET title=?,content=?,updated_at=? WHERE id=?";
        $this->dbh=new MyDB_update($sql,$data,"ssss");
        $this->is_edit=$this->dbh->sql_execute();
    }

    public function get_is_edit(){
        return $this->is_edit;
    }
}
class Create extends ToDo{
    protected MyDB_insert $dbh;
    private $insert_id;

    // SQL文の実行
    // data（title,content,updated_at,id）
    public function execute($data){
        parent::execute($data);
        $sql="INSERT INTO posts(title,content,created_at,updated_at) VALUES (?,?,?,?)";
        $this->dbh=new MyDB_insert($sql,$data,"ssss");
        $this->insert_id=$this->dbh->sql_execute();
    }

    public function get_insert_id(){
        return $this->insert_id;
    }
}
class Delete extends Todo{
    protected MyDB_delete $dbh;
    private $is_delete;

    public function execute($data){
        parent::execute($data);
        $sql="DELETE FROM posts WHERE id=?";
        $this->dbh=new MyDB_delete($sql,$data,"i");
        $this->is_delete=$this->dbh->sql_execute();
    }

    public function get_is_delete(){
        return $this->is_delete;
    }
}
?>