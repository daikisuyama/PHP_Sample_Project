<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap for CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title><?= $page_title; ?></title>
    <script src="functions.js"></script>
</head>
<?php
// エラー表示
error_reporting(E_ALL);
// クラスの読み込み
require_once "class/display.php";
require_once "class/mydb.php";
require_once "error/functions.php";
?>