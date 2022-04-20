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
    // 関数の読み込み
    require_once "functions.php";

    // GETパラメータ受け取り
    // page_index：検索一覧の何ページ目か（1-indexed）
    $page_index=isset($_GET['page']) ? $_GET["page"] : 1;
    // 検索ワード（nullの場合はindexページ）
    $search_word=isset($_GET['word']) ? $_GET["word"]: null;
    // ソート順（作成日時順：created_at、タイトル名順：title、更新日時順：updated_at）
    $sort_which=isset($_GET['sort_which']) ? $_GET["sort_which"]: "created_at";
    ?>
    <h1>ToDo List</h1>
    
    <div>
        <!-- ソート用の選択肢 -->
        <select id="sort_which">
            <option value="created_at">作成日時順</option>
            <option value="title">タイトル名順</option>
            <option value="updated_at">更新日時順</option>
        </select>
        <form action="create.php">
            <!-- ボタンを押すと未入力の状態で作成 -->
            <button type="submit">作成</button>
        </form>
        <!-- 検索 -->
        <input type="button" value="検索" onclick="search_dialog()">
    </div>

    <main>
        <div id="list">
            <?php
            // 全数取得（SQL）
            if(is_null($search_word)){
                $sql="SELECT * FROM posts";
                $data=[];
                $dbh=new MyDB_select($sql,$data,"");
            }else{
                $sql="SELECT * FROM posts WHERE title LIKE ?";
                $data=[$search_word];
                $dbh=new MyDB_select($sql,$data,"s");
            }
            $dbh->sql_execute();

            // item_sum:合計のitem数
            $item_sum=$dbh->get_sum();
            // page_item_max:ページに表示する最大件数
            $page_item_max=5;
            // page_num：合計のページ数
            $page_num=(int)ceil($item_sum/$page_item_max);
            // page_item_num：今いるページ（$page_index）に実際に表示する件数
            $page_item_num=min($page_item_max,$item_sum-$page_item_max*($page_index-1));

            if($page_num==0){
                // 登録されているToDoがない場合
                print is_null($search_word) ? "登録されているToDoがありません。<br>" : "該当するToDoがありません。<br>";
                print '<a href="index.php">一覧へ</a>';
            }elseif($page_index>$page_num || $page_index<1){
                // 範囲外のページにアクセスしようとした場合
                print "存在しないページです。<br>";
                print '<a href="index.php">一覧へ</a>';
                exit();
            }

            // 一覧表示
            // ORDER BY句の指定
            if(in_array($sort_which,array("created_at","title","updated_at"),true)){
                $sql_order=" ORDER BY {$sort_which} ";
                $sql_order.= $sort_which==="title" ? "asc": "desc";
                $sql_order.=", id desc LIMIT ?,?";
            }else{
                print "存在しないページです。<br>";
                print '<a href="index.php">一覧へ</a>';
                exit();
            }
            // SELECT句の指定
            if(is_null($search_word)){
                $sql="SELECT * FROM posts";
                $sql.=$sql_order;
                $data=[$page_item_max*($page_index-1),$page_item_num];
                $dbh->set_sql($sql);
                $dbh->set_data($data);
                $dbh->set_data_types("ii");
            }else{
                $sql="SELECT * FROM posts WHERE title LIKE ?";
                $sql.=$sql_order;
                $data=[$search_word,$page_item_max*($page_index-1),$page_item_num];
                $dbh->set_sql($sql);
                $dbh->set_data($data);
                $dbh->set_data_types("sii");
            }
            $dbh->sql_execute();

            // 一覧の表示
            while($rec=$dbh->get_record()){
                $id=$rec["id"];
                $title=$rec["title"];
                print '<div class="list_item">';
                // タイトル
                print '<a href="view.php?id='.$id.'">'.htmlspecialchars($title,ENT_QUOTES,"UTF-8")."</a>";
                // 削除ボタン
                print '<form method="POST" action="delete_confirm.php" onsubmit="return delete_dialog()">';
                print '<input type="hidden" name="id" value="'.$id.'">';
                print '<input type="submit" value="削除">';
                print '</form>';
                print '</div>';
            }
            ?>
        </div>
    </main>

    <footer id ="paging">
        <?php
        // ページング
        $url_params=array("page"=>$page_index,"word"=>$search_word,"sort_which"=>$sort_which);
        $paging=new Paging($page_index,$page_num,$url_params);
        $paging->create_paging();
        ?>
    </footer>

    <script type="text/javascript">sort_page();</script>
</body>
</html>