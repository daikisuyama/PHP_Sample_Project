<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="view.css">
    <title>View Page</title>
</head>
<body>
    <header>
        <a href="index.php">一覧へ</a>
        <input type="submit" value="削除">
    </header>
    <main>
        <!-- ToDoリストのアイテムの情報を取得 -->
        <?php
        require_once "functions.php";
        try{
            // GETパラメータ受け取り
            $item_id=$_GET["id"];

            // データベースへの接続
            $dbh=db_access();

            // SQL文の実行
            $sql="SELECT title,content,created_at,updated_at FROM posts WHERE id=?";
            $stmt=$dbh->prepare($sql);
            $data=[$item_id];
            $stmt->execute($data);

            // レコードを取得
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $item_title=$rec["title"];
            $item_content=$rec["content"];
            $item_created_at=$rec["created_at"];
            $item_updated_at=$rec["updated_at"];

            // データベースからの切断
            $dbh=null;
        }catch(Exception $e){
            print "以下の不具合が発生しております。<br>";
            print $e->getMessage();
            exit();
        }
        ?>

        <!-- フォームの作成 -->
        <form method="POST" action="edit_confirm.php">
            <input type="text" name="title" value="<?php print $item_title?>"></input>
            <textarea name="content"><?php print $item_content?></textarea>
            <input type="hidden" name="id" value="<?php print $item_id ?>">
            <input type="hidden" name="created_at" value="<?php print $item_created_at ?>">
            <input type="hidden" name="updated_at" value="<?php print $item_updated_at ?>">
            <input type="submit" value="完了">
        </form>
    </main>

</body>