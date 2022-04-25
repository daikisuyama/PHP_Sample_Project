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

// pathへparamsをPOSTでリクエスト
function post(path,params) {
    const form=document.createElement("form");
    form.method="POST";
    form.action=path;
  
    for(const key in params){
      if(params.hasOwnProperty(key)){
        const hiddenField=document.createElement("input");
        hiddenField.type="hidden";
        hiddenField.name=key;
        hiddenField.value=params[key];
        form.appendChild(hiddenField);
      }
    }
    document.body.appendChild(form);
    form.submit();
}

// Ajax：https://www.w3schools.com/xml/ajax_intro.asp
// FormDataオブジェクト：https://developer.mozilla.org/ja/docs/Learn/Forms/Sending_forms_through_JavaScript

function form_init(handle_file_path,alert_num_succeed,alert_num_fail,form_id,check_dialog){
    window.addEventListener("load",()=>{
        function confirm(){
            const XHR = new XMLHttpRequest();
            // FormDataオブジェクトとform要素の紐付け
            const FD  = new FormData(form);
            // リクエストの設定
            XHR.open("POST",handle_file_path);
            // データの送信
            XHR.send(FD);
    
            // レスポンス後の処理
            XHR.addEventListener('readystatechange',()=>{
                if(XHR.readyState===4 && XHR.status===200) {
                    post("index.php",{alert_stmt:alert_num_succeed,alert_text:XHR.responseText});
                }else if(XHR.readyState===4){
                    post("index.php",{alert_stmt:alert_num_fail,alert_text:XHR.responseText});
                }
            });
        }
        // form要素の取得
        const form=document.getElementById(form_id);
        // formのsubmitイベントを上書き
        form.addEventListener("submit",(event)=>{
            event.preventDefault();
            if(check_dialog())confirm();
        });
    });
}

function title_validate(){
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

function create_form_init(){
    check_dialog=title_validate;
    form_init("confirm/create.php",1,11,"create_form",check_dialog);
}

function edit_form_init(){
    check_dialog=title_validate;
    form_init("confirm/edit.php",2,12,"edit_form",check_dialog);
}

function delete_form_init(){
    check_dialog=()=>confirm('本当に削除しますか？');
    form_init("confirm/delete.php",3,13,"delete_form",check_dialog);
}