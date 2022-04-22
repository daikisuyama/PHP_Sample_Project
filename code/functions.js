// イベントの返り値としてtrue/falseを返す

// フォームのバリデーションチェック用ダイアログ（タイトルのみ）
function check_dialog(){
    let title=document.getElementById("form_title").value;
    if(title.length>31){
        alert("タイトルが長すぎます\n");
        return false;
    }else if(title===""){
        alert("タイトルが未入力です\n");
        return false;
    }else{
        return true;
    }
}

// 削除確認用ダイアログ
function delete_dialog(){
    return confirm('本当に削除しますか？');
}

// ソートの選択状態の変更、選択状態の変更に伴ったページの遷移
// DMOContenがLoadされてから実行しないとおかしなことに
function sort_page(){
    document.addEventListener('DOMContentLoaded',function(){
        let sort_which_option=document.getElementById("sort_which");
        let url_params=new URLSearchParams(location.search);
        sort_which.addEventListener("change",function(){
            url_params.set("sort_which",sort_which.value);
            location.href="index.php?"+url_params.toString();
        });
        if(url_params.get("sort_which")===null){
            sort_which.options[0].selected=true;
        }else{
            sort_which.querySelector(`option[value='${url_params.get("sort_which")}']`).selected=true;
        }
    });
}