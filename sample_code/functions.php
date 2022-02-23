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
?>