<!doctype html>
<html lang="ja">
    <?php
    $page_title="削除確認用ページ";
    require "default/head.php";
    require "class/import.php";
    require_once "error/functions.php";
    ?>
    <body>
        <main>
            <?php
            // フォーム受け取り
            $id=$_POST["id"];

            // SQLによるDELETE
            $delete=new Delete([$id]);
            $is_delete=$delete->get_is_delete();
            // エラー処理
            print $is_delete ? "削除が完了しました。<br>" : "存在しないTodoです。<br>";
            print '<a href="index.php">一覧へ</a>';
            ?>
        </main>
    </body>
</html>