<!doctype html>
<html lang="ja">
    <?php
    // ヘッド
    require "index/head.php";
    ?>
    <body>
        <?php
        // ナビゲーションバー
        require "index/navbar.php";
        // メインコンテンツ
        require "index/main.php";
        // フッター
        require "index/pagination.php";
        // Bootstrap for JS
        require "bootstrap_js.php";
        ?>
    </body>
</html>