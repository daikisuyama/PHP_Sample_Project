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

// ページング機能の作成
// $page_index：何ページ目か
// $page_num：合計で何ページか
// $page_num：今いるページ（クエリパラメータを除く）
// $url_param：クエリパラメータを連想配列で
function create_paging($page_index,$page_num,$page_name,$url_param){
    if($page_num<=6){
        for($i=1;$i<=$page_num;++$i){
            if($page_index==$i){
                print '<div class="paging_item_now">';
            }else{
                print '<div class="paging_item">';
            }
            $url_param["page"]=$i;
            print "<a href='${page_name}?".http_build_query($url_param)."'>${i}</a>";
            print '</div>';
        }
    }else{
        if($page_index<=3){
            for($i=1;$i<=$page_index+1;++$i){
                if($page_index==$i){
                    print '<div class="paging_item_now">';
                }else{
                    print '<div class="paging_item">';
                }
                $url_param["page"]=$i;
                print "<a href='${page_name}?".http_build_query($url_param)."'>${i}</a>";
                print '</div>';
            }
            print '<div class="paging_item">';
            print "…";
            print '</div>';
            print '<div class="paging_item">';
            $url_param["page"]=$page_num;
            print "<a href='${page_name}?".http_build_query($url_param)."'>${page_num}</a>";
            print '</div>';
        }elseif($page_index>=$page_num-2){
            print '<div class="paging_item">';
            $url_param["page"]=1;
            print "<a href='${page_name}?".http_build_query($url_param)."'>1</a>";
            print '</div>';
            print '<div class="paging_item">';
            print "…";
            print '</div>';
            for($i=$page_index-1;$i<=$page_num;++$i){
                if($page_index==$i){
                    print '<div class="paging_item_now">';
                }else{
                    print '<div class="paging_item">';
                }
                $url_param["page"]=$i;
                print "<a href='${page_name}?".http_build_query($url_param)."'>${i}</a>";
                print '</div>';
            }
        }else{
            print '<div class="paging_item">';
            $url_param["page"]=1;
            print "<a href='${page_name}?".http_build_query($url_param)."'>1</a>";
            print '</div>';
            print '<div class="paging_item">';
            print "…";
            print '</div>';
            for($i=$page_index-1;$i<=$page_index+1;++$i){
                if($page_index==$i){
                    print '<div class="paging_item_now">';
                }else{
                    print '<div class="paging_item">';
                }
                $url_param["page"]=$i;
                print "<a href='${page_name}?".http_build_query($url_param)."'>${i}</a>";
                print '</div>';
            }
            print '<div class="paging_item">';
            print "…";
            print '</div>';
            print '<div class="paging_item">';
            $url_param["page"]=$page_num;
            print "<a href='${page_name}?".http_build_query($url_param)."'>${page_num}</a>";
            print '</div>';
        }
    }
}
?>
