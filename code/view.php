<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="view.css">
    <title>View Page</title>
    <script src="function.js"></script>
</head>
<body>
    <?php
    // エラー表示
    error_reporting(E_ALL);
    // 関数の読み込み
    require_once "functions.php";

    // GETパラメータ受け取り
    if(isset($_GET["id"])){
        $item_id=$_GET["id"];
    }else{
        print "存在しないページです。<br>";
        print '<a href="index.php">一覧へ</a>';
        exit();
    }
    ?>
    <div>
        <a href="index.php">一覧へ</a>
        <!-- 削除（確認ダイアログ） -->
        <form method="POST" action="delete_confirm.php" onsubmit="return delete_dialog()">
            <input type="hidden" name="id" value="<?php print $item_id ?>">
            <input type="submit" value="削除">
        </form>
    </div>
    <main>
        <!-- ToDoリストのアイテムの情報を取得 -->
        <?php
        // データベースへの接続
        $dbh=db_access();

        // SQL文の実行
        $sql="SELECT title,content,updated_at FROM posts WHERE id=?";
        $stmt=$dbh->prepare($sql);
        $data=[$item_id];
        $stmt->execute($data);

        // レコードを取得
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        if($rec){
            $item_title=$rec["title"];
            $item_content=$rec["content"];
            $item_updated_at=$rec["updated_at"];
        }else{
            echo "該当するToDoがありません。<br>";
            exit();
        }
        
        // データベースからの切断
        $dbh=null;
        ?>

        <!-- フォームの作成 -->
        <form method="POST" action="edit_confirm.php" onsubmit="return check_dialog()">
            <input type="text" name="title" value="<?php print $item_title?>" id="form_title"></input><br>
            <textarea name="content"><?php print $item_content?></textarea>
            <input type="hidden" name="id" value="<?php print $item_id ?>">
            <input type="submit" value="完了">
        </form>
    </main>

</body>