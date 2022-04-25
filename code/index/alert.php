<?php
if(isset($_POST["alert_stmt"])){
    $alert_stmt=$_POST["alert_stmt"];
    $alert_text=$_POST["alert_text"];
    if($alert_stmt==="1"){
        echo <<< EOM
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <a class="alert-link" href="edit.php?id={$alert_text}">ToDo No.{$alert_text}</a> is created!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        EOM;
    }elseif($alert_stmt==="10"){
        echo <<< EOM
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ToDo is not created...
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        EOM;
    }
}
?>