<?php
if(isset($_POST["alert_stmt"])){
    $alert_stmt=$_POST["alert_stmt"];
    $alert_text=$_POST["alert_text"];
    
    if($alert_stmt==="1"){
        $alert_message="<a class='alert-link' href='edit.php?id={$alert_text}'>ToDo No.{$alert_text}</a> is created!";
    }elseif($alert_stmt==="11"){
        $alert_message="ToDo is not created...";
    }elseif($alert_stmt==="2"){
        $alert_message="<a class='alert-link' href='edit.php?id={$alert_text}'>ToDo No.{$alert_text}</a> is updated!";
    }elseif($alert_stmt==="12"){
        $alert_message="ToDo is not updated...";
    }

    echo <<< EOM
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {$alert_message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    EOM;
}
?>