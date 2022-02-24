<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="view.css"> -->
    <title>Create Confirm Page</title>
</head>
<body>
    <main>
        <?php
        require_once "functions.php";
        try{
            // フォーム受け取り
            $post=sanitize($_POST);
            $item_title=$post["title"];
            $item_content=$post["content"];
            $item_created_at=date("Y-m-d H:i:s");
            $item_updated_at=$item_created_at;

            // データベースへの接続
            $dbh=db_access();

            // SQL文の実行
            $sql="INSERT INTO posts(title,content,created_at,updated_at) VALUES (?,?,?,?)";
            $stmt=$dbh->prepare($sql);
            $data=[$item_title,$item_content,$item_created_at,$item_updated_at];
            $stmt->execute($data);
            $item_id=$dbh->lastInsertId();

            // データベースからの切断
            $dbh=null;

            print '<a href="index.php">一覧へ</a>';
            print '<a href="view.php?id='.$item_id.'">編集画面へ</a>';
            print "作成が完了しました";

        }catch(Exception $e){
            print "以下の不具合が発生しております。<br>";
            print $e->getMessage();
            exit();
        }
        ?>
    </main>

</body>


