<?php
$page_title="編集確認用ページ";
require("./head.php");
?>
<body>
    <main>
        <!-- アイテムの情報の更新処理 -->
        <!-- Ajaxかiframeを使いたかった -->
        <?php
        // エラー表示
        error_reporting(E_ALL);
        // クラスの読み込み
        require_once "mydb.php";

        // フォーム受け取り
        if(isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["content"])){
            $id=$_POST["id"];
            $title=$_POST["title"];
            $content=$_POST["content"];
            $updated_at=date("Y-m-d H:i:s");
        }else{
            print "存在しないページです。<br>";
            print '<a href="index.php">一覧へ</a>';
            exit();
        }

        $sql="UPDATE posts SET title=?,content=?,updated_at=? WHERE id=?";
        $data=[$title,$content,$updated_at,$id];
        $dbh=new MyDB_update($sql,$data,"ssss");
        $dbh->sql_execute();

        print '<a href="index.php">一覧へ</a><br>';
        print '<a href="view.php?id='.$id.'">編集画面へ</a><br>';
        print "更新が完了しました<br>";
        ?>
        <!-- フォームの作成 -->
    </main>

</body>


