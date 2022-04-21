<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" type="text/css" href="view.css"> -->
    <title>Create Confirm Page</title>
</head>
<body>
    <main>
        <?php
        // エラー表示
        error_reporting(E_ALL);
        // クラスの読み込み
        require_once "mydb.php";
        // フォーム受け取り
        if(isset($_POST["title"]) && isset($_POST["content"])){
            $title=$_POST["title"];
            $content=$_POST["content"];
            $created_at=date("Y-m-d H:i:s");
            $updated_at=$created_at;
        }else{
            print "存在しないページです。<br>";
            print '<a href="index.php">一覧へ</a>';
            exit();
        }

        $sql="INSERT INTO posts(title,content,created_at,updated_at) VALUES (?,?,?,?)";
        $data=[$title,$content,$created_at,$updated_at];
        $dbh=new MyDB_insert($sql,$data,"ssss");
        $dbh->sql_execute();
        $id=$dbh->insert_id();

        print '<a href="index.php">一覧へ</a><br>';
        print '<a href="view.php?id='.$id.'">編集画面へ</a><br>';
        print "作成が完了しました<br>";
        ?>
    </main>

</body>


