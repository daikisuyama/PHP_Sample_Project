<?php
$id=$rec["id"];
$title=$rec["title"];
?>
<div class="col-12">
    <div class="card h-100 mb-20">
        <!-- それぞれのToDoへ -->
        <div class="card_body h-100">
            <h1 class="card_title">
                <a class="link-secondary" href="view.php?id=<?= $id ?>"><?= htmlspecialchars($title,ENT_QUOTES,"UTF-8") ?></a>
            </h1>
        </div>
        <!-- 削除ボタン -->
        <div class="text-right mt-auto mb-2 mr-2">
            <form method="POST" action="delete_confirm.php" onsubmit="return delete_dialog()" class="text-right">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="submit" class="btn btn-secondary" value="Delete">
            </form>
        </div>
    </div>
</div>