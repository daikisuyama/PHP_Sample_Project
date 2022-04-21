<?php
$page_title="削除確認用ページ";
require("./head.php");
?>
<body>
    <main>
        <?php
        // フォーム受け取り
        $id=$_POST["id"];

        // SQLによるDELETE
        $sql="DELETE FROM posts WHERE id=?";
        $data=[$id];
        $data_types="i";
        $dbh=new MyDB_delete($sql,$data,$data_types);
        print $dbh->sql_execute() ? "削除が完了しました。<br>" : "存在しないTodoです。<br>";
        print '<a href="index.php">一覧へ</a>';
        ?>
    </main>
</body>