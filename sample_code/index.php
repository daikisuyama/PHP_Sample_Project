<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page</title>
</head>
<body>
    <h1>ToDo List</h1>
    <header>
        <form action="sort.php">
            <select>
                <option value="id" selected>作成日時順</option>
                <option value="title">タイトル名順</option>
                <option value="updated_at">更新日時順</option>
            </select>
        </form>
        <form action="create.php">
            <!-- ボタンを押すと未入力の状態で作成 -->
            <!-- 押した際にソート順は更新日時順になる -->
            <button type="submit">
                作成
            </button>
        </form>
    </header>
    <main>
        <div id="list">
            <!-- リストの一覧を表示（最大5件） -->
            <!-- リストの要素を押すと選択が変化する（合わせてプレビューも変化） -->
            <!-- それぞれの要素に削除ボタンを設置 -->
            <!-- ここは後々ソート順にも依存しそう -->
            <?php
            require_once "functions.php";
            try{
                // データベースへの接続
                $dbh=db_access();

                // SQL文の実行
                $sql="SELECT id,title,content,created_at,updated_at FROM posts WHERE 1";
                $stmt=$dbh->prepare($sql);
                $stmt->execute();

                // データベースからの切断
                $dbh=null;

                // 一覧の表示
                while(true){
                    // レコードの取得
                    $rec==$stmt->fetch(PDO::FETCH_ASSOC);
                    if(!$rec){
                        break;
                    }else{
                        print '<div class="list_item">'.$rec["title"]."</div>";
                    }
                }
            }catch(Exception $e){
                print "不具合が発生しております。<br>";
                print "原因は".$e->getMessage()."です";
                exit();
            }
            ?>
        </div>
        <div id="preview">
            <!-- 選択しているタスクの内容を表示 -->
            <!-- 編集の完了状態を示すボタンも右下に設置 -->
        </div>
    </main>
    <footer>
        <!-- ページング機能 -->
    </footer>
</body>
</html>