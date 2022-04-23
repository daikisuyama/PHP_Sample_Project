<main class="row">
    <?php
    // インスタンスの生成
    if(is_null($search_word)){
        $disp=new Index($page_index,$search_word,$sort_which);
    }else{
        $disp=new Search($page_index,$search_word,$sort_which);
    }

    // エラーの表示
    require "display_error.php";

    // 一覧の表示
    while($rec=$disp->get_record()){
        // ToDoの表示
        require "todo.php";
    }
    ?>
</main>