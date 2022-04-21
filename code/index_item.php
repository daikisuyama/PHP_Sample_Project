<div class="list_item">
    <a href="view.php?id=<?= $id ?>"><?= htmlspecialchars($title,ENT_QUOTES,"UTF-8") ?></a>
    <!-- 削除ボタン -->
    <form method="POST" action="delete_confirm.php" onsubmit="return delete_dialog()">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="submit" value="削除">
    </form>
</div>