<?php
$id=$rec["id"];
$title=$rec["title"];
$created_at=$rec["created_at"];
$updated_at=$rec["updated_at"]
?>
<div class="col-12 todo_col">
    <div class="card h-100 todo_item">
        <!-- それぞれのToDoへ -->
        <div class="card_body h-100">
            <h1 class="card_title ml-2 mt-2">
                <?= htmlspecialchars($title,ENT_QUOTES,"UTF-8") ?>
            </h1>
        </div>
        <div class="d-flex justify-content-end mb-2">
            <div class="card-text text-right mr-2">
                <!-- 作成日時 -->
                <p class="mb-0">Created：<?= htmlspecialchars($created_at,ENT_QUOTES,"UTF-8") ?></p>
                <!-- 更新日時 -->
                <p class="mb-0">Updated：<?= htmlspecialchars($updated_at,ENT_QUOTES,"UTF-8") ?></p>
            </div>
            <!-- 表示ボタン -->
            <form action="view.php" method="get" class="mt-auto">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <!-- ボタンを押すとToDoを参照 -->
                <button type="submit" class="btn btn-secondary mr-2">View</button>
            </form>
            <!-- 削除ボタン -->
            <form method="POST" action="delete_confirm.php" onsubmit="return delete_dialog()" class="text-right mt-auto">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="submit" class="btn btn-secondary mr-2" value="Delete">
            </form>
        </div>
    </div>
</div>