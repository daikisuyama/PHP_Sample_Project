<!doctype html>
<html lang="ja">
    <?php
    $page_title="編集確認用ページ";
    require "default/head.php";
    require "class/import.php";
    ?>
    <body>
        <main>
            <!-- アイテムの情報の更新処理 -->
            <!-- Ajaxかiframeを使いたかった -->
            <?php
            // フォーム受け取り
            if(isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["content"])){
                $id=$_POST["id"];
                $title=$_POST["title"];
                $content=$_POST["content"];
                $updated_at=date("Y-m-d H:i:s");
            }else{
                err_404();
            }

            // インスタンスの生成
            $edit=new Edit([$title,$content,$updated_at,$id]);
            $is_edit=$edit->get_is_edit();

            // エラー処理
            print '<a href="index.php">一覧へ</a><br>';
            print '<a href="view.php?id='.$id.'">編集画面へ</a><br>';
            print "更新が完了しました<br>";
            ?>
        </main>
    </body>
</html>

