<!-- 上の階層を呼び出すときは絶対パス -->
<?php
// エラー表示
error_reporting(E_ALL);
// ファイルの読み込み
$page_title="編集用ページ";
require "default/head.php";
// GETパラメータの受け取り
require "get_params.php";
?>
<script type="text/javascript">edit_form_init();</script>
<script type="text/javascript">delete_form_init();</script>