<!doctype html>
<html lang="ja">
    <!-- ヘッド -->
    <?php require "index/head.php"; ?>
    <body>
        <div class="container">
            <!-- アラート -->
            <?php require "index/alert.php";?>
            <!-- ナビゲーションバー -->
            <?php require "index/navbar.php";?>
            <!-- メインコンテンツ -->
            <?php require "index/main.php";?>
            <!-- ページネーション -->
            <?php require "index/pagination.php";?>
        </div>
        <!-- Bootstrap for JS -->
        <?php require "default/bootstrap_js.php"; ?>
    </body>
</html>