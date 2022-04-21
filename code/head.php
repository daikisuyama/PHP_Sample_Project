<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title><?= $page_title; ?></title>
    <script src="function.js"></script>
</head>
<?php
// エラー表示
error_reporting(E_ALL);
// クラスの読み込み
require_once "display.php";
require_once "paging.php";
require_once "mydb.php";
?>