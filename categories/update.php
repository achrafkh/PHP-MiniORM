<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/Entity/Category.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $cat = Category::Find($id);

    if (!$cat) {
        $_SESSION["msg"] = ["danger" => "Can't Find Category"];
        header("Location: /categories");
    }
}

include($_SERVER['DOCUMENT_ROOT'] . "/template/head.php");
?>
<div class="container" style="width: 60%">
    <h2>Update <strong><?= $cat->getName() ?> </strong><a style="margin-left: 5px;" class="btn btn-danger pull-right"
                                                          href="categories">Add New
            Category</a></h2>

    <form method="POST" action="/categories/manage.php">
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="hidden" class="form-control" name="id" id="id" value="<?= $id ?>">
            <input type="text" class="form-control" name="name" id="name" value="<?= $cat->getName() ?>">
        </div>

        <button type="submit" name="update" class="btn btn-default">Submit</button>
    </form>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.php");
?>

