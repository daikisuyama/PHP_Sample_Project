<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Index Page</title>
    <script src="function.js"></script>
</head>
<body>
    <?php
    // エラー表示
    error_reporting(E_ALL);
    // GETパラメータ受け取り
    // page_index：検索一覧の何ページ目か（1-indexed）
    // していない場合は1
    $page_index=isset($_GET['page']) ? $_GET["page"] : 1;
    // 検索ワード
    // nullの場合はindexページ
    $search_word=isset($_GET['word']) ? $_GET["word"]: null;
    // ソート順（作成日時順：0、タイトル名順：1、更新日時順：2）
    $sort_which=isset($_GET['sort_which']) ? $_GET["sort_which"]: 0;
    ?>
    <h1>ToDo List</h1>
    
    <div>
        <!-- ソート用の選択肢、未実装 -->
        <select id="sort_which">
            <option value="0">作成日時順</option>
            <option value="1">タイトル名順</option>
            <option value="2">更新日時順</option>
        </select>
        <form action="create.php">
            <!-- ボタンを押すと未入力の状態で作成 -->
            <button type="submit">作成</button>
        </form>
        <!-- 検索 -->
        <input type="button" value="検索" onclick="search_dialog()">
    </div>

    <main>
        <!-- この辺りは綺麗にできそう -->
        <div id="list">
            <!-- リストの一覧を表示（最大5件） -->
            <?php
            require_once "functions.php";
            try{
                // データベースへの接続
                $dbh=db_access();

                // SQL文の実行（全数取得、item_sum）
                if(is_null($search_word)){
                    $sql_1="SELECT COUNT(*) FROM posts";
                    $stmt_1=$dbh->prepare($sql_1);
                    $stmt_1->execute();
                }else{
                    $sql_1="SELECT COUNT(*) FROM posts WHERE title LIKE ?";
                    $stmt_1=$dbh->prepare($sql_1);
                    $data=[$search_word];
                    $stmt_1->execute($data);
                }
                $item_sum=$stmt_1->fetchColumn(); // 次行の最初のカラムを返す
                // page_item_max:ページに表示する最大件数
                $page_item_max=5;
                // page_num：合計のページ数
                $page_num=(int)ceil($item_sum/$page_item_max);

                if($page_num==0){
                    // 登録されているToDoがない場合
                    print is_null($search_word) ? "登録されているToDoがありません。<br>" : "該当するToDoがありません。<br>";
                    print '<a href="index.php">一覧へ</a>';
                }elseif($page_index>$page_num || $page_index<1){
                    // 範囲外のページにアクセスしようとした場合
                    print "存在しないページです。<br>";
                    print '<a href="index.php">一覧へ</a>';
                    // データベースからの切断
                    $dbh=null;
                    exit();
                }

                // SQL文の実行（必要な件数分取得）
                // ソート順を元にしたORDER BY句
                switch($sort_which){
                    case 0:
                        $sql_order=" ORDER BY created_at desc, id desc LIMIT ?,?";
                        break;
                    case 1:
                        $sql_order=" ORDER BY title asc, id asc LIMIT ?,?";;
                        break;
                    case 2:
                        $sql_order=" ORDER BY updated_at desc, id desc LIMIT ?,?";
                        break;
                    default:
                        print "存在しないページです。<br>";
                        print '<a href="index.php">一覧へ</a>';
                        $dbh=null;
                        exit();
                }
                
                // ページごとにクエリを走らせる（件数少ないし妥協）
                // 変数をバインドする際にexecute関数にarrayで渡すと文字列に暗黙的に変換されてしまう
                // 参照：https://www.php.net/manual/ja/pdostatement.execute.php
                // bindValue関数で型を指定してやると解決
                if(is_null($search_word)){
                    $sql_2="SELECT id,title,content,created_at,updated_at FROM posts";
                    $sql_2.=$sql_order;
                    $stmt_2=$dbh->prepare($sql_2);
                    // page_item_num：ページ（$page_index）に表示する件数
                    $page_item_num=min($page_item_max,$item_sum-$page_item_max*($page_index-1));
                    $stmt_2->bindValue(1,$page_item_max*($page_index-1),PDO::PARAM_INT);
                    $stmt_2->bindValue(2,$page_item_num,PDO::PARAM_INT);
                }else{
                    $sql_2="SELECT id,title,content,created_at,updated_at FROM posts WHERE title LIKE ?";
                    $sql_2.=$sql_order;
                    $stmt_2=$dbh->prepare($sql_2);
                    // page_item_num：ページ（$page_index）に表示する件数
                    $page_item_num=min($page_item_max,$item_sum-$page_item_max*($page_index-1));
                    $stmt_2->bindValue(1,$search_word,PDO::PARAM_STR);
                    $stmt_2->bindValue(2,$page_item_max*($page_index-1),PDO::PARAM_INT);
                    $stmt_2->bindValue(3,$page_item_num,PDO::PARAM_INT);
                }
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
                        print '<a href="view.php?id='.$item_id.'">'.htmlspecialchars($item_title,ENT_QUOTES,"UTF-8")."</a>";
                        // 削除（確認ダイアログ）
                        print '<form method="POST" action="delete_confirm.php" onsubmit="return delete_dialog()">';
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
        $paging=new Paging($page_index,$page_num,array("page"=>$page_index,"word"=>$search_word,"sort_which"=>$sort_which));
        $paging->create_paging();
        ?>
    </footer>

    <script type="text/javascript">sort_page();</script>
</body>
</html>