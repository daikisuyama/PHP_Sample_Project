<!-- 上の階層を呼び出すときは絶対パス -->
<?php
$page_style="index/style.css";
$page_title="トップページ";
require __DIR__."/../head.php";
require_once "class/display.php";
// GETパラメータの受け取り
require "get_params.php";
?>
<script type="text/javascript">sort_page();</script>