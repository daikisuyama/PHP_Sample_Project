<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="view.css">
    <title>View Page</title>
    <script type="text/javascript">
        import check_dialog from "function";
    </script>
</head>
<body>
    <div>
        <a href="index.php">一覧へ</a>
    </div>
    <main>
        <!-- フォームの作成 -->
        <form method="POST" action="create_confirm.php" onsubmit="return check_dialog()">
            <input type="text" name="title" value="" id="element_title"></input><br>
            <textarea name="content"></textarea>
            <input type="submit" value="完了">
        </form>
    </main>
</body>