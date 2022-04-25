<?php
if($disp->get_page_num()==0){
    err_no_item();
}
if($disp->get_page_index()>$disp->get_page_num() || $disp->get_page_index()<1){
    // 範囲外のページ
    err_404();
}