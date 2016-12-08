<?php
session_start();
if (!empty($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];
}
session_destroy();
/**
 * Created by PhpStorm.
 * User: pach
 * Date: 04/12/16
 * Time: 21:53
 */
require_once($_SERVER['DOCUMENT_ROOT'] . "/Load.php");

$categories = Category::AllwithCount();


include($_SERVER['DOCUMENT_ROOT'] . "/template/head.php");
?>

    <div class="container">
        <h2>Manage Categories <a style="margin-left: 5px;" class="btn btn-primary pull-right"
                                 href="/categories/create.php">Add New Category</a></h2>

        <p>Total : <?= count($categories) ?></p>
        <?php if (isset($msg)) { ?>
            <div class="alert alert-<?= key($msg) ?>">
                <strong><?= ucfirst(key($msg)) ?>!</strong> <?= $msg[key($msg)] ?>
            </div>
        <?php } ?>

        <?php if (!empty($categories)) { ?>
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>News Count</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category) { ?>
                    <tr>
                        <td><a style="text-decoration:none"
                               href="news?catid=<?= $category->getId() ?>"><?= $category->getName() ?></a></td>
                        <td style="width: 9%"><?= $category->count ?></td>
                        <td style="width: 25%;">
                            <form method="POST" action="/categories/manage.php">
                                <a style="margin-left: 5px;" class="btn btn-primary"
                                   href="/categories/update.php?id=<?= $category->getId() ?>">Update</a>
                                <button name="delete" style="margin-left: 5px;" class="btn btn-danger"
                                        value="<?= $category->getId() ?>">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } elseif(!isset($msg)) { ?>
            <div class="alert alert-warning">
                <strong>Oops!</strong> There are No categories Yet
            </div>
        <?php } ?>
    </div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.php");
?>