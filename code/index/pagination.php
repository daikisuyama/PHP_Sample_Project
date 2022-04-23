<?php
$url_params=array("page_index"=>$page_index,"search_word"=>$search_word,"sort_which"=>$sort_which);
$pagination=new Pagination($disp->get_page_index(),$disp->get_page_num(),$url_params);
?>
<nav class="fixed-bottom" aria-label="Pagination">
    <ul class="pagination pagination-lg justify-content-center">
        <?php $pagination->create_pagination(); ?>
    </ul>
</nav>