<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="view.css">
    <title>View Page</title>
</head>
<body>
    <header>
        <a href="index.php">一覧へ</a>
        <input type="submit" value="削除">
    </header>
    <main>
        <!-- フォームの作成 -->
        <form method="POST" action="create_confirm.php">
            <input type="text" name="title" value=""></input>
            <textarea name="content"></textarea>
            <input type="submit" value="完了">
        </form>
    </main>
</body>