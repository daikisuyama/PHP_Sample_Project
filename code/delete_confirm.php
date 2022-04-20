<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="view.css"> -->
    <title>Delete Confirm Page</title>
</head>
<body>
    <main>
        <?php
        // エラー表示
        error_reporting(E_ALL);
        // 関数の読み込み
        require_once "functions.php";

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