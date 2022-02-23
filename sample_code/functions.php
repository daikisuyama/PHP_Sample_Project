<?php
// データベースへの接続
function db_access(){
    // データベースへの接続
    $dsn="mysql:dbname=sample_project;host=localhost;charset=utf8";
    $user="root";
    $password="";
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

// 複数の入力データへの安全対策
// クロスサイトスクリプティングを避けるために文字列に直す
function sanitize($before){
    foreach($before as $key=>$value){
        $after[$key]=htmlspecialchars($value,ENT_QUOTES,"UTF-8");
    }
    return $after;
}
?>