<!-- 上の階層を呼び出すときは絶対パス -->
<?php
$page_style="edit/style.css";
$page_title="編集用ページ";
require __DIR__."/../head.php";
require_once __DIR__."/../class/todo.php";
// GETパラメータの受け取り
require "get_params.php";
?>