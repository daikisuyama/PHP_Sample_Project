<?php
// ページング機能
class Pagination{
    // page_index：index.phpの何ページ目にいるか
    // page_num：index.phpのページ数
    private int $page_index,$page_num;
    // url_params：今いるページのクエリパラメータ
    private array $url_params;

    function __construct($page_index,$page_num,$url_params){
        $this->page_index=$page_index;
        $this->page_num=$page_num;
        $this->url_params=$url_params;
    }

    // 3点ドットの作成
    private function create_ellipsis(){
        echo <<< EOM
        <li class="page-item disabled bg-light">
            <a class="page-link text-white bg-secondary border-secondary" href="#" tabindex="-1">…</a>
        </li>
        EOM;
    }

    // 最初のページの作成
    private function create_first(){
        $this->create_consecutive(1,1);
    }

    // 最後のページの作成
    private function create_last(){
        $this->create_consecutive($this->page_num,$this->page_num);
    }

    // 連続したページの作成
    // 今いるページが含まれる場合、そのページのclass名を変更
    private function create_consecutive($begin,$end){
        for($i=$begin;$i<=$end;++$i){
            $this->url_params["page_index"]=$i;
            $a_link="index.php?".http_build_query($this->url_params);
            // echo $a_link;
            if($i===$this->page_index){
                echo <<< EOM
                <li class="page-item active">
                    <a class="page-link bg-secondary border-secondary" href="{$a_link}">{$i}</a>
                </li>
                EOM;
            }else{
                echo <<< EOM
                <li class="page-item">
                    <a class="page-link text-white bg-secondary border-secondary" href="{$a_link}">{$i}</a>
                </li>
                EOM;
            }
        }
        // 元に戻す
        $this->url_params["page_index"]=$this->page_index;
    }

    private function create_minimum(){
        // 連続したページの作成（全てのページ）
        $this->create_consecutive(1,$this->page_num);
    }

    private function create_maximum(){
        // 前半の3点ドットの作成
        if(3<$this->page_index){
            $this->create_first();
            $this->create_ellipsis();
        }

        // 連続したページの作成
        $begin=3<$this->page_index ? $this->page_index-1 : 1;
        $end=($this->page_index)<($this->page_num-2) ? $this->page_index+1 : $this->page_num;
        $this->create_consecutive($begin,$end);

        // 後半の3点ドットの作成
        if(($this->page_index)<($this->page_num-2)){
            $this->create_ellipsis();
            $this->create_last();
        }
    }

    public function create_pagination(){
        if($this->page_num<=6){
            $this->create_minimum();
        }else{
            $this->create_maximum();
        }
    }
}