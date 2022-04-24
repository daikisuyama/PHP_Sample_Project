<main class="row">
    <?php
    // インスタンスの生成
    $view=new View([$id]);

    // 結果の取得
    $rec=$view->get_record();

    // エラーの表示
    require "display_error.php";

    // 編集用フォームの表示
    require "form.php"
    ?>
</main>