<nav class="navbar navbar-expand-md fixed-top navbar-dark p-3">
    <div class="container-fluid p-0">
        <!-- App名 -->
        <a class="navbar-brand" href="indeex.php">ToDo app</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-0">
                <li class="nav-item my-auto">
                    <!-- ソート用の選択肢 -->
                    <select id="sort_which" class="form-select">
                        <option value="created_at">作成日時順</option>
                        <option value="title">タイトル名順</option>
                        <option value="updated_at">更新日時順</option>
                    </select>
                </li>
            </ul>
            <ul class="navbar-nav me-auto mb-0 ml-auto">
                <li class="nav-item mr-2">
                    <!-- 作成用ボタン -->
                    <form action="create.php">
                        <!-- ボタンを押すと未入力の状態で作成 -->
                        <button type="submit" class="btn btn-light">Create</button>
                    </form>
                </li>
                <li class="nav-item">
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
                </li>
            </ul>
        </div>
    </div>
</nav>