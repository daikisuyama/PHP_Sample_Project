<!-- 上の階層を呼び出すときは絶対パス -->
<?php
$page_title="編集用ページ";
require __DIR__."/../default/head.php";

// エラー表示
error_reporting(E_ALL);
// クラスの読み込み
require_once "class/import.php";
require_once "error/functions.php";
// GETパラメータの受け取り
require "get_params.php";
?>
<script type="text/javascript">edit_form_init();</script>
<script type="text/javascript">delete_form_init();</script>