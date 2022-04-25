// ソートの選択状態の変更、選択状態の変更に伴ったページの遷移
// DMOContenがLoadされてから実行しないとおかしなことに
function sort_page_init(){
    window.addEventListener("load",()=>{
        let sort_which=document.getElementById("sort_which");
        let url_params=new URLSearchParams(location.search);
        sort_which.addEventListener("change",()=>{
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

// Ajax：https://www.w3schools.com/xml/ajax_intro.asp
// FormDataオブジェクト：https://developer.mozilla.org/ja/docs/Learn/Forms/Sending_forms_through_JavaScript

function create_form_init(){
    window.addEventListener("load",()=>{
        function create_confirm(){
            const XHR = new XMLHttpRequest();
            // FormDataオブジェクトとform要素の紐付け
            const FD  = new FormData(form);
            // リクエストの設定
            XHR.open("POST","create_confirm.php");
            // データの送信
            XHR.send(FD);
    
            // レスポンス後の処理
            XHR.addEventListener('readystatechange',()=>{
                if(XHR.readyState===4 && XHR.status===200) {
                    post("index.php",{alert_stmt:1,alert_text:XHR.responseText})
                }else if(XHR.readyState===4){
                    post("index.php",{alert_stmt:10,alert_text:XHR.responseText})
                }
            });
        }
        // form要素の取得
        const form=document.getElementById("create_form");
        // formのsubmitイベントを上書き
        form.addEventListener("submit",(event)=>{
            event.preventDefault();
            create_confirm();
        });
    });
}


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

function send_edit_form(){

}

function post(path, params, method='post') {
    const form = document.createElement('form');
    form.method = method;
    form.action = path;
  
    for (const key in params) {
      if (params.hasOwnProperty(key)) {
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = key;
        hiddenField.value = params[key];
  
        form.appendChild(hiddenField);
      }
    }
  
    document.body.appendChild(form);
    form.submit();
}