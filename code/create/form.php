<div class="col-12 todo_col">
    <div class="card todo_item p-3">
        <!-- ToDo -->
        <h2 class="card-title">ToDo No. ?</h2>
        <!-- 作成欄 -->
        <form method="POST" action="create_confirm.php" onsubmit="return check_dialog()">
            <div class="form-group">
                <label for="form_title">Title</label>
                <input type="text" name="title" class="form-control" id="form_title" value="">
            </div>
            <div class="form-group">
                <label for="form_content">Content</label>
                <textarea type="text" name="content" class="form-control" id="form_content" value="" rows=5></textarea>
            </div>
            <div class="form-group mb-0">
                <input type="submit" class="btn btn-secondary col-2" value="Submit">
            </div>
        </form>
    </div>
</div>