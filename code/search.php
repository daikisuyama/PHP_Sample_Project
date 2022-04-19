<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="search.css">
    <title>Search Page</title>
    <script type="text/javascript">
        function search_dialog(){
            let search_word=prompt("検索したい言葉は？","");
            location.href="search.php?word="+search_word;
        }
    </script>
</head>
<body>
    <?php
    // GETパラメータ受け取り
    // page_index：検索一覧の何ページ目か（1-indexed）
    $page_index=$_GET["page"];
    // 指定ない場合は1
    if(is_null($_GET["page"])){
        $page_index=1;
    }
    // 検索ワード
    $search_word=$_GET["word"];
    ?>
    <h1>ToDo List</h1>
    <div>
        <!-- ソート用の選択肢、未実装 -->
        <form action="sort.php">
            <select>
                <option value="id" selected>作成日時順</option>
                <option value="title">タイトル名順</option>
                <option value="updated_at">更新日時順</option>
            </select>
        </form>
        <form action="create.php">
            <!-- ボタンを押すと未入力の状態で作成 -->
            <button type="submit">作成</button>
        </form>
        <!-- 検索 -->
        <input type="button" value="検索" onclick="search_dialog()">
    </div>
    <main>
        <div id="list">
            <!-- 検索の一覧を表示（最大5件） -->
            <?php
            require_once "functions.php";
            try{
                // データベースへの接続
                $dbh=db_access();
                
                // SQL文の実行（全数取得、item_sum）
                $sql_1="SELECT COUNT(*) FROM posts WHERE title=?";
                $stmt_1=$dbh->prepare($sql_1);
                $data=[$search_word];
                $stmt_1->execute($data);
                $item_sum=$stmt_1->fetchColumn(); // 次行の最初のカラムを返す
                // page_item_max:ページに表示する最大件数
                $page_item_max=5;
                // page_num：合計のページ数
                $page_num=(int)ceil($item_sum/$page_item_max);

                if($page_num==0){
                    // 登録されているToDoがない場合
                    print "該当するToDoがありません。<br>";
                    print '<a href="index.php">一覧へ</a>';
                }elseif($page_index>$page_num){
                    // 範囲外のページにアクセスしようとした場合
                    print "存在しないページです。<br>";
                    print '<a href="index.php">一覧へ</a>';
                    // データベースからの切断
                    $dbh=null;
                    exit();
                }

                // SQL文の実行（必要な件数分取得）
                $sql_2="SELECT id,title,content,created_at,updated_at FROM posts WHERE title=? LIMIT ?,?";
                $stmt_2=$dbh->prepare($sql_2);
                // page_item_num：ページ（$page_index）に表示する件数
                $page_item_num=min($page_item_max,$item_sum-$page_item_max*($page_index-1));
                $stmt_2->bindValue(1,$search_word,PDO::PARAM_STR);
                $stmt_2->bindValue(2,$page_item_max*($page_index-1),PDO::PARAM_INT);
                $stmt_2->bindValue(3,$page_item_num,PDO::PARAM_INT);
                $stmt_2->execute();

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
                        print '</div>';
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
    <footer id ="paging">
        <!-- ページング機能 -->
        <?php
        create_paging($page_index,$page_num,"search.php",array("word" => $search_word));
        ?>
    </footer>
</body>
</html>