<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/Load.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $news = News::Find($id);
    $categories = Category::All();

    if (!$news) {
        $_SESSION["msg"] = ["danger" => "Can't Find News"];
        header("Location: /news");
    }
}


include($_SERVER['DOCUMENT_ROOT'] . "/template/head.php");
?>

    <div class="container" style="width: 60%">
        <h2>Latest <strong><?= $news->getTitle() ?> </strong> <a style="margin-left: 5px;"
                                                                 class="btn btn-danger pull-right"
                                                                 href="/news/create.php">Add New
                News</a></h2>

        <form method="POST" action="/news/manage.php">
            <div class="form-group">
                <label for="name">News Name:</label>
                <input type="hidden" class="form-control" name="id" id="id" value="<?= $id ?>">
                <input type="text" class="form-control" name="title" id="title" value="<?= $news->getTitle() ?>">

            </div>
            <div class="form-group">
                <label for="name">News Description:</label>
                <textarea class="form-control" name="description" id="description"><?= $news->getDesc() ?></textarea>
            </div>
            <div class="form-group">
                <label for="sel1">Select Category:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <?php foreach ($categories as $category) { ?>
                        <option
                            value="<?= $category->getId() ?>" <?= $category->getId() != $news->getCategoryId() ?: "selected" ?>><?= $category->getName() ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-default">Submit</button>
        </form>
    </div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.php");
?>