<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/Entity/Category.php");
$categories = Category::All();

if(count($categories) == 0){
    $_SESSION["msg"] = ["warning" => "You have to create a Category first"];
    header("Location: /categories");
}

include($_SERVER['DOCUMENT_ROOT'] . "/template/head.php");
?>
    <div class="container" style="width: 60%">
        <h2>Add News </h2>

        <form method="POST" action="/news/manage.php">
            <div class="form-group">
                <label for="title">News Title:</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="description">News Description:</label>
                <textarea class="form-control" name="description" id="description"> </textarea>
            </div>
            <div class="form-group">
                <label for="sel1">Select Category:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" name="create" class="btn btn-default" value="create">Submit</button>
        </form>
    </div>

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.php");
?>