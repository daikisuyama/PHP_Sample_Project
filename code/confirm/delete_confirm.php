<?php
// ファイル読み込み
require "../class/import.php";
require_once "../error/functions.php";

// フォーム受け取り
if(!isset($_POST["id"]))err_404();
$id=$_POST["id"];

//インスタンスの生成
$delete=new Delete([$id]);
$is_delete=$delete->get_is_delete();
echo $id;