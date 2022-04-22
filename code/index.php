<!doctype html>
<html lang="ja">
    <?php
    // ヘッド
    require "index/head.php";
    ?>
    <body class="vh-100 vw-100">
        <div class="container">
            <?php
            // ナビゲーションバー
            require "index/navbar.php";
            // メインコンテンツ
            require "index/main.php";
            // ページネーション
            require "index/pagination.php";
            // Bootstrap for JS
            require "bootstrap_js.php";
            ?>
        </div>
    </body>
</html>