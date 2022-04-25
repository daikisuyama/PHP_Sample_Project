<?php
// エラー表示
error_reporting(E_ALL);
// ファイルの読み込み
$page_title="トップページ";
require "default/head.php";
// GETパラメータの受け取り
require "get_params.php";
?>
<script type="text/javascript">sort_page_init();</script>
<script type="text/javascript">delete_form_init();</script>