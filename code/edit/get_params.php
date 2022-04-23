<?php
// ToDoのid
$id=filter_input(INPUT_GET,"id");
if(is_null($id)){
    err_404();
}
?>