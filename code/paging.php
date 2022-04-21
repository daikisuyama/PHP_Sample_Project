<?php
// ページング機能
class Paging{
    // page_index：index.phpの何ページ目にいるか
    // page_num：index.phpのページ数
    // url_params：今いるページのクエリパラメータ
    private int $page_index,$page_num;
    private array $url_params;

    function __construct($page_index,$page_num,$url_params){
        $this->page_index=$page_index;
        $this->page_num=$page_num;
        $this->url_params=$url_params;
    }

    // 3点ドットの作成
    private function create_ellipsis(){
        print "<div class='paging_item'>…</div>";
    }

    // 最初のページの作成
    private function create_first(){
        $this->create_between(1,1);
    }

    // 最後のページの作成
    private function create_last(){
        $this->create_between($this->page_num,$this->page_num);
    }

    // 連続したページの作成
    // 今いるページが含まれる場合、そのページのclass名を変更
    private function create_between($begin,$end){
        for($i=$begin;$i<=$end;++$i){
            $class_name=$this->page_index==$i ? "'paging_item_now'" : "'paging_item'";
            print "<div class={$class_name}>";
            $this->url_params["page"]=$i;
            print "<a href='index.php?".http_build_query($this->url_params)."'>{$i}</a>";
            print "</div>";
        }
        // 元に戻す
        $this->url_params["page"]=$this->page_index;
    }

    private function create_paging_minimum(){
        // 連続したページの作成（全てのページ）
        $this->create_between(1,$this->page_num);
    }

    private function create_paging_maximum(){
        // 前半の3点ドットの作成
        if(3<$this->page_index){
            $this->create_first();
            $this->create_ellipsis();
        }

        // 連続したページの作成
        $begin=3<$this->page_index ? $this->page_index-1 : 1;
        $end=($this->page_index)<($this->page_num-2) ? $this->page_index+1 : $this->page_num;
        $this->create_between($begin,$end);

        // 後半の3点ドットの作成
        if(($this->page_index)<($this->page_num-2)){
            $this->create_ellipsis();
            $this->create_last();
        }
    }

    public function create_paging(){
        if($this->page_num<=6){
            $this->create_paging_minimum();
        }else{
            $this->create_paging_maximum();
        }
    }
}
?>