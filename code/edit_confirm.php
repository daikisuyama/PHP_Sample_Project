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
        // エラー表示
        error_reporting(E_ALL);
        // 関数の読み込み
        require_once "functions.php";

        // フォーム受け取り
        if(isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["content"])){
            $item_id=$_POST["id"];
            $item_title=$_POST["title"];
            $item_content=$_POST["content"];
            $item_updated_at=date("Y-m-d H:i:s");
        }else{
            print "存在しないページです。<br>";
            print '<a href="index.php">一覧へ</a>';
            exit();
        }

        // データベースへの接続
        $dbh=db_access();

        // SQL文の実行
        $sql="UPDATE posts SET title=?,content=?,updated_at=? WHERE id=?";
        $stmt=$dbh->prepare($sql);
        $data=[$item_title,$item_content,$item_updated_at,$item_id];
        $stmt->execute($data);

        // データベースからの切断
        $dbh=null;

        print '<a href="index.php">一覧へ</a><br>';
        print '<a href="view.php?id='.$item_id.'">編集画面へ</a><br>';
        print "更新が完了しました<br>";
        ?>
        <!-- フォームの作成 -->
    </main>

</body>


