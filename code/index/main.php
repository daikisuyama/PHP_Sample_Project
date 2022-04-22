<main class="row">
    <?php
    // SQL文の実行
    $url_params=[$page_index,$search_word,$sort_which];
    if(is_null($search_word)){
        $sql_params=["SELECT * FROM posts",[],""];
    }else{
        $sql_params=["SELECT * FROM posts WHERE title LIKE ?",[$search_word],"s"];
    }
    $disp=new Display($url_params,$sql_params);

    // 一覧の表示
    while($rec=$disp->get_record()){
        // ToDoの表示
        require "todo.php";
    }

    // ページ表示の際のエラー
    require "page_error.php";
    ?>
</main>