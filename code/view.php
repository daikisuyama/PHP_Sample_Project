<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="view.css">
    <title>View Page</title>
    <script type="text/javascript">
        // フォームのバリデーションチェック
        function check_dialog(){
            let title=document.getElementById("element_title").value;
            if(title.length>31){
                alert("タイトルが長すぎます\n");
                return false;
            }else if(title===""){
                alert("タイトルが未入力です\n");
                return false;
            }else{
                return true;
            }
        }
    </script>
</head>
<body>
    <?php
    // GETパラメータ受け取り
    $item_id=$_GET["id"];
    ?>
    <div>
        <a href="index.php">一覧へ</a>
        <!-- 削除（確認ダイアログ） -->
        <form method="POST" action="delete_confirm.php" onsubmit='return window.confirm("本当に削除しますか？")'>
            <input type="hidden" name="id" value="<?php print $item_id ?>">
            <input type="submit" value="削除">
        </form>
    </div>
    <main>
        <!-- ToDoリストのアイテムの情報を取得 -->
        <?php
        require_once "functions.php";
        try{
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
        <form method="POST" action="edit_confirm.php" onsubmit="return check_dialog()">
            <input type="text" name="title" value="<?php print $item_title?>" id="element_title"></input><br>
            <textarea name="content"><?php print $item_content?></textarea>
            <input type="hidden" name="id" value="<?php print $item_id ?>">
            <input type="hidden" name="created_at" value="<?php print $item_created_at ?>">
            <input type="submit" value="完了">
        </form>
    </main>

</body>