<!-- 上の階層を呼び出すときは絶対パス -->
<?php
$page_style="index/style.css";
$page_title="トップページ";
require __DIR__."/../head.php";
// 追加のクラスの読み込み
require_once __DIR__."/../class/display.php";
require_once __DIR__."/../class/pagination.php";
// GETパラメータの受け取り
require "get_params.php";
?>
<script type="text/javascript">sort_page();</script>