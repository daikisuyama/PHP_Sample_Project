<?php
$id=$rec["id"];
$title=$rec["title"];
?>
<div class="col-12">
    <div class="card">
        <!-- それぞれのToDoへ -->
        <div class="card_body">
            <h3 class="card_title">
                <a href="view.php?id=<?= $id ?>"><?= htmlspecialchars($title,ENT_QUOTES,"UTF-8") ?></a>
            </h3>
            <!-- 削除ボタン -->
            <form method="POST" action="delete_confirm.php" onsubmit="return delete_dialog()" class="text-right">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="submit" class="btn btn-primary" value="削除">
            </form>
        </div>
    </div>
</div>