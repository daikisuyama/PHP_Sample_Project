<?php
$page_title="削除確認用ページ";
require("./head.php");
?>
<body>
    <main>
        <?php
        // エラー表示
        error_reporting(E_ALL);
        // クラスの読み込み
        require_once "mydb.php";

        // フォーム受け取り
        $id=$_POST["id"];

        // 存在の確認（削除時のエラーが出ないため）
        $sql="DELETE FROM posts WHERE id=?";
        $data=[$id];
        $data_types="i";
        $dbh=new MyDB_delete($sql,$data,$data_types);
        print $dbh->sql_execute() ? "削除が完了しました。<br>" : "存在しないTodoです。<br>";
        print '<a href="index.php">一覧へ</a>';
        ?>
    </main>
</body>