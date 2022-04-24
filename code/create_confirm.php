<!doctype html>
<html lang="ja">
    <?php
    $page_title="作詞確認用ページ";
    require "head.php";
    ?>
    <body>
        <div class="container">
            <main>
                <?php
                // フォーム受け取り
                if(isset($_POST["title"]) && isset($_POST["content"])){
                    $title=$_POST["title"];
                    $content=$_POST["content"];
                    $created_at=date("Y-m-d H:i:s");
                    $updated_at=$created_at;
                }else{
                    err_404();
                    exit();
                }

                // インスタンスの生成
                $create=new Create([$title,$content,$created_at,$updated_at]);
                $insert_id=$create->get_insert_id();
                // エラー処理
                print '<a href="index.php">一覧へ</a><br>';
                print '<a href="view.php?id='.$insert_id.'">編集画面へ</a><br>';
                print "作成が完了しました<br>";
                ?>
            </main>
        </div>
        <!-- Bootstrap for JS -->
        <?php require "bootstrap_js.php"; ?>
    </body>
</html>