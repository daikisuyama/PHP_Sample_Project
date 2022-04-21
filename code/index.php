<?php
$page_title="トップページ";
require("./head.php");
?>
<body>
    <?php
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
            if(!in_array($sort_which,array("created_at","title","updated_at"),true)){
                print "存在しないページです。<br>";
                print '<a href="index.php">一覧へ</a>';
                exit();
            }
            if(is_null($search_word)){
                $url_params=[$page_index,$search_word,$sort_which];
                $sql_params=["SELECT * FROM posts",[],""];
            }else{
                $url_params=[$page_index,$search_word,$sort_which];
                $sql_params=["SELECT * FROM posts WHERE title LIKE ?",[$search_word],"s"];
            }
            $disp=new Display($url_params,$sql_params);

            if($disp->get_page_num()==0){
                // 登録されているToDoがない場合
                print "該当するToDoがありません。<br>";
                print '<a href="index.php">一覧へ</a>';
            }elseif($disp->get_page_index()>$disp->get_page_num() || $disp->get_page_index()<1){
                // 範囲外のページにアクセスしようとした場合
                print "存在しないページです。<br>";
                print '<a href="index.php">一覧へ</a>';
                exit();
            }

            // 一覧の表示
            while($rec=$disp->get_record()){
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
        $url_params=array("page"=>$disp->get_page_index(),"word"=>$disp->get_search_word(),"sort_which"=>$disp->get_sort_which());
        $paging=new Paging($disp->get_page_index(),$disp->get_page_num(),$url_params);
        $paging->create_paging();
        ?>
    </footer>

    <script type="text/javascript">sort_page();</script>
</body>
</html>