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
        require_once "functions.php";
        try{
            // フォーム受け取り
            $post=sanitize($_POST);
            $item_id=$post["id"];

            // データベースへの接続
            $dbh=db_access();

            // SQL文の実行
            $sql="DELETE FROM posts WHERE id=?";
            $stmt=$dbh->prepare($sql);
            $data=[$item_id];
            $stmt->execute($data);

            // データベースからの切断
            $dbh=null;

            print '<a href="index.php">一覧へ</a>';
            print "削除が完了しました";

        }catch(Exception $e){
            print "以下の不具合が発生しております。<br>";
            print $e->getMessage();
            exit();
        }
        ?>
    </main>

</body>


