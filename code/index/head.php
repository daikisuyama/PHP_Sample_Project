<?php
$page_title="トップページ";
require __DIR__."/../default/head.php";
// エラー表示
error_reporting(E_ALL);
// クラスの読み込み
require_once "class/import.php";
require_once "error/functions.php";
// GETパラメータの受け取り
require "get_params.php";
?>
<script type="text/javascript">sort_page_init();</script>
<script type="text/javascript">delete_form_init();</script>