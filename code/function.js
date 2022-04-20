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

// 検索用ダイアログ
function search_dialog(){
    let search_word=prompt("検索したい言葉は？","");
    if(search_word!==null){
        location.href="index.php?word="+search_word;
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
        let sort_which=document.getElementById("sort_which");
        let search_params=new URLSearchParams(location.search);
        sort_which.addEventListener("change",function(){
            search_params.set("sort_which",sort_which.value);
            location.href="index.php?"+search_params.toString();
        });
        if(search_params.get("sort_which")===null){
            sort_which.options[0].selected=true;
        }else{
            sort_which.options[search_params.get("sort_which")].selected=true;
        }
    });
}