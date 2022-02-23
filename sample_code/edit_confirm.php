<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="view.css"> -->
    <title>Edit Confirm Page</title>
</head>
<body>
    <main>
        <!-- アイテムの情報の更新処理 -->
        <!-- Ajaxかiframeを使いたかった -->
        <?php
        require_once "functions.php";
        try{
            // フォーム受け取り
            $post=sanitize($_POST);
            $item_id=$post["id"];
            $item_title=$post["title"];
            $item_content=$post["content"];
            $item_created_at=$post["created_at"];
            $item_updated_at=$post["updated_at"];

            // データベースへの接続
            $dbh=db_access();

            // SQL文の実行
            $sql="UPDATE posts SET title=?,content=?,created_at=?,updated_at=? WHERE id=?";
            $stmt=$dbh->prepare($sql);
            $data=[$item_title,$item_content,$item_created_at,$item_updated_at,$item_id];
            print var_dump($data);
            $stmt->execute($data);

            // データベースからの切断
            $dbh=null;

            print '<a href="index.php">一覧へ</a>';
            print '<a href="view.php?id='.$item_id.'">編集画面へ</a>';
            print "更新が完了しました";

        }catch(Exception $e){
            print "以下の不具合が発生しております。<br>";
            print $e->getMessage();
            exit();
        }
        ?>
        <!-- フォームの作成 -->
    </main>

</body>


