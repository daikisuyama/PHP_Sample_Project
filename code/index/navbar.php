<nav class="navbar fixed-top">
    <!-- ソート用の選択肢 -->
    <select id="sort_which" class="form-select border-secondary">
        <option value="created_at">作成日時順</option>
        <option value="title">タイトル名順</option>
        <option value="updated_at">更新日時順</option>
    </select>
    <form action="create.php">
        <!-- ボタンを押すと未入力の状態で作成 -->
        <button type="submit" class="btn btn-light">Create</button>
    </form>
    <!-- 検索 -->
    <form action="index.php" method="get">
        <div class="input-group">
            <div class="form-outline">
                <input type="search" id="form_search" class="form-control" placeholder="Search" name="search_word">
            </div>
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</nav>