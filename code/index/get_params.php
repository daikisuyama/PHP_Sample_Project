<?php
// page_index：検索一覧の何ページ目か（1-indexed）
$page_index=filter_input(INPUT_GET,"page_index");
if(is_null($page_index)){
    $page_index=1;
}elseif(!($page_index=(int)$page_index)){
    err_404();
}
// 検索ワード（nullの場合はindexページ）
$search_word=filter_input(INPUT_GET,"search_word");

// ソート順（作成日時順：created_at、タイトル名順：title、更新日時順：updated_at）
$sort_which=filter_input(INPUT_GET,"sort_which");
if(is_null($sort_which)){
    $sort_which="created_at";
}elseif(!in_array($sort_which,array("created_at","title","updated_at"),true)){
    err_404();
}