<div>
    <!-- ソート用の選択肢 -->
    <select id="sort_which">
        <option value="created_at">作成日時順</option>
        <option value="title">タイトル名順</option>
        <option value="updated_at">更新日時順</option>
    </select>
    <form action="create.php">
        <!-- ボタンを押すと未入力の状態で作成 -->
        <button type="submit">作成</button>
    </form>
    <!-- 検索 -->
    <input type="button" value="検索" onclick="search_dialog()">
</div>