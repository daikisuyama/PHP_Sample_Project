<?php
$page_title="編集用ページ";
require("./head.php");
?>
<body>
    <?php
    // エラー表示
    error_reporting(E_ALL);
    // クラスの読み込み
    require_once "display.php";
    require_once "paging.php";
    require_once "mydb.php";
    // GETパラメータ受け取り
    if(isset($_GET["id"])){
        $id=$_GET["id"];
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
            <input type="hidden" name="id" value="<?php print $id ?>">
            <input type="submit" value="削除">
        </form>
    </div>
    <main>
        <!-- ToDoの情報を取得 -->
        <?php
        $view=new View($id);
        $rec=$view->get_record();
        if(is_null($rec)){
            echo "該当するToDoがありません。<br>";
            exit();
        }
        ?>

        <!-- 編集用フォーム -->
        <form method="POST" action="edit_confirm.php" onsubmit="return check_dialog()">
            <input type="text" name="title" value="<?= $rec["title"]; ?>" id="form_title"></input><br>
            <textarea name="content"><?= $rec["content"]; ?></textarea><br>
            <input type="hidden" name="id" value="<?= $rec["id"]; ?>">
            <input type="text" name="created_at" value="<?= $rec["created_at"]; ?>" disabled><br>
            <input type="text" name="updated_at" value="<?= $rec["updated_at"]; ?>" disabled><br>
            <input type="submit" value="完了">
        </form>
    </main>

</body>