<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="index.css">
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
            <button type="submit">作成</button>
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
            // page_index：リスト一覧の何ページ目か（1-indexed）
            // 指定ない場合は1
            // todo:ないページを指定した時
            $page_index=$_GET["page"];
            if(is_null($_GET["page"])){
                $page_index=1;
            }
            try{
                // データベースへの接続
                $dbh=db_access();
                
                // SQL文の実行（全数取得、item_sum）
                $sql_1="SELECT COUNT(*) FROM posts";
                $stmt_1=$dbh->prepare($sql_1);
                $stmt_1->execute();
                // 次行の最初のカラムを返す
                $item_sum=$stmt_1->fetchColumn();

                // SQL文の実行（必要な件数分取得）
                $sql_2="SELECT id,title,content,created_at,updated_at FROM posts LIMIT ?,?";
                $stmt_2=$dbh->prepare($sql_2);
                // page_item_num：ページに表示する件数
                $page_item_num=min(5,$item_sum-5*($page_index-1));
                $data=[5*($page_index-1),$page_item_num];
                $stmt_2->execute($data);

                // データベースからの切断
                $dbh=null;

                // 一覧の表示
                while(true){
                    // レコードの取得
                    $rec=$stmt_2->fetch(PDO::FETCH_ASSOC);
                    if(!$rec){
                        break;
                    }else{
                        $item_id=$rec["id"];
                        $item_title=$rec["title"];
                        // タイトルと削除ボタンを表示
                        print '<div class="list_item">';
                        print '<a href="view.php?id='.$item_id.'">'.$item_title."</a>";
                        // 削除（確認ダイアログ）
                        print '<form method="POST" action="delete_confirm.php" onsubmit="return window.confirm('."'本当に削除しますか？'".')">';
                        print '<input type="hidden" name="id" value="'.$item_id.'">';
                        print '<input type="submit" value="削除">';
                        print '</form>';
                    }
                }
            }catch(Exception $e){
                print "以下の不具合が発生しております。<br>";
                print $e->getMessage();
                exit();
            }
            ?>
        </div>
    </main>
    <footer>
        <!-- ページング機能 -->
        <!-- ページごとにクエリを走らせる（件数少ないし妥協） -->

    </footer>
</body>
</html>