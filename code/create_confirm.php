<?php
// ファイル読み込み
require "class/import.php";
require_once "error/functions.php";
if(!isset($_POST["title"]) || !isset($_POST["content"])){
    err_404();
}

// フォーム受け取り
$title=$_POST["title"];
$content=$_POST["content"];
$created_at=date("Y-m-d H:i:s");
$updated_at=$created_at;

// インスタンスの生成
$create=new Create([$title,$content,$created_at,$updated_at]);
echo $insert_id=$create->get_insert_id();
?>