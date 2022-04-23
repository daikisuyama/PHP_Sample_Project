<!-- viewとcreateをまとめる？ -->
<?php
require_once "mydb.php";
class Todo{
}
// view.php
// 一つのToDoを表示
class View extends ToDo{
    protected MyDB_select $dbh;
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

class Create extends ToDo{

}
class Delete extends Todo{

}
?>