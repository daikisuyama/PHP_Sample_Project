<?php
// エラー表示
error_reporting(E_ALL);
// ファイル読み込み
require_once "../class/import.php";
require_once "../error/functions.php";
// フォーム受け取り
if(!isset($_POST["id"]) || !isset($_POST["title"]) || !isset($_POST["content"]))err_404();
$id=$_POST["id"];
$title=$_POST["title"];
$content=$_POST["content"];
$updated_at=date("Y-m-d H:i:s");

// インスタンスの生成
$edit=new Edit([$title,$content,$updated_at,$id]);
echo $id;