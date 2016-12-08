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
$id = "%";
if (isset($_GET["catid"])) {
    $id = $_GET["catid"];
}
$news = News::AllwithCname($id);


include($_SERVER['DOCUMENT_ROOT'] . "/template/head.php");
?>
<div class="container">
    <h2>Manage News <a style="margin-left: 5px;" class="btn btn-primary pull-right" href="/news/create.php">Add News</a>
    </h2>

    <p>Total : <?= count($news) ?></p>
    <?php if (isset($msg)) { ?>
        <div class="alert alert-<?= key($msg) ?>">
            <strong><?= ucfirst(key($msg)) ?>!</strong> <?= $msg[key($msg)] ?>
        </div>
    <?php } ?>

    <?php if (!empty($news)) { ?>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($news as $item) { ?>
                <tr>
                    <td><?= $item->getTitle() ?></td>
                    <td><?= $item->getDesc() ?></td>
                    <td><a style="text-decoration:none"
                           href="news?catid=<?= $item->getCategoryId() ?>"><?= $item->cname ?></a></td>
                    <td style="width: 25%;">
                        <form method="POST" action="/news/manage.php">
                            <a style="margin-left: 5px;" class="btn btn-primary"
                               href="/news/update.php?id=<?= $item->getId() ?>">Update</a>
                            <button name="delete" style="margin-left: 5px;" class="btn btn-danger"
                                    value="<?= $item->getId() ?>">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-warning">
            <strong>Oops!</strong> No News in this Categories
        </div>
    <?php } ?>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.php");
?>
