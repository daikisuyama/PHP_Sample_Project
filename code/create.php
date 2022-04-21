<?php
$page_title="作成ページ";
require("./head.php");
?>
<body>
    <div>
        <a href="index.php">一覧へ</a>
    </div>
    <main>
        <!-- フォームの作成 -->
        <form method="POST" action="create_confirm.php" onsubmit="return check_dialog()">
            <input type="text" name="title" value="" id="form_title"></input><br>
            <textarea name="content"></textarea>
            <input type="submit" value="完了">
        </form>
    </main>
</body>