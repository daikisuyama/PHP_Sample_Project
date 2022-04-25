<?php
// 指定されたページがない場合
function err_404(){
    header("HTTP/1.1 404 Not Found");
    include("404.php");
    exit();
}

// 登録されているToDoがない場合
function err_no_item(){
    echo "該当するToDoがありません。<br>";
    echo '<a href="index.php">一覧へ</a>';
    exit();
}