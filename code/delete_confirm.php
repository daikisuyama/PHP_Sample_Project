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

            // SQL文の実行（存在の確認→削除）
            $data=[$item_id];

            $sql_1="SELECT COUNT(*) FROM posts WHERE id=?";
            $stmt_1=$dbh->prepare($sql_1);
            $stmt_1->execute($data);

            $sql_2="DELETE FROM posts WHERE id=?";
            $stmt_2=$dbh->prepare($sql_2);
            $stmt_2->execute($data);

            $item_sum=$stmt_1->fetchColumn();

            // データベースからの切断
            $dbh=null;

            print '<a href="index.php">一覧へ</a><br>';
            if($item_sum==0){
                print "存在しないTodoです。<br>";
            }else{
                print "削除が完了しました。<br>";
            }
        }catch(Exception $e){
            print "以下の不具合が発生しております。<br>";
            print $e->getMessage();
            exit();
        }
        ?>
    </main>
</body>