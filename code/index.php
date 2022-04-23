<!doctype html>
<html lang="ja">
    <?php
    // ヘッド
    require "index/head.php";
    ?>
    <body>
        <div class="container">
            <?php
            // ナビゲーションバー
            require "index/navbar.php";
            // メインコンテンツ
            require "index/main.php";
            // ページネーション
            require "index/pagination.php";
            ?>
        </div>
        <!-- Bootstrap for JS -->
        <?php require "bootstrap_js.php"; ?>
    </body>
</html>