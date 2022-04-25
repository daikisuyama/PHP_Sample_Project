<?php
$id=$rec["id"];
$title=$rec["title"];
$content=$rec["content"];
$created_at=$rec["created_at"];
$updated_at=$rec["updated_at"]
?>

<div class="col-12 todo_col">
    <div class="card todo_item p-3">
        <div class="d-flex">
            <h2 class="card-title">ToDo No.<?= $id ?></h2>
            <!-- 削除ボタン -->
            <form method="POST" action="delete_confirm.php" onsubmit="return delete_dialog()" class="ml-4">
                <input type="submit" class="btn btn-secondary" value="Delete">
            </form>
        </div>
        <!-- 編集欄 -->
        <form method="POST" id="edit_form">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
                <label for="form_title">Title</label>
                <input type="text" name="title" class="form-control" id="form_title" value="<?= $title ?>">
            </div>
            <div class="form-group">
                <label for="form_content">Content</label>
                <textarea type="text" name="content" class="form-control" id="form_content" value="<?= $title ?>" rows=5></textarea>
            </div>
            <div class="form-group">
                <p class="mb-0">Created：<?= htmlspecialchars($created_at,ENT_QUOTES,"UTF-8") ?></p>
                <p class="mb-0">Updataed：<?= htmlspecialchars($updated_at,ENT_QUOTES,"UTF-8") ?></p>
            </div>
            <div class="form-group mb-0">
                <input type="submit" class="btn btn-secondary col-2" value="Submit">
            </div>  
        </form>
    </div>
</div>