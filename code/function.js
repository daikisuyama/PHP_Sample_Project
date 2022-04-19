// フォームのバリデーションチェック用ダイアログ（タイトルのみ）
export function check_dialog(){
    let title=document.getElementById("element_title").value;
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
export function search_dialog(){
    let search_word=prompt("検索したい言葉は？","");
    location.href="index.php?word="+search_word;
}