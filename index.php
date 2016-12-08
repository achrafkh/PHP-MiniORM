<?php
/**
 * Created by PhpStorm.
 * User: pach
 * Date: 04/12/16
 * Time: 21:53
 */
require_once($_SERVER['DOCUMENT_ROOT']."/Load.php");

$categories = Category::AllwithCount();

include($_SERVER['DOCUMENT_ROOT']."/template/head.php");
?>
<div class="container">
    <h2>Latest News</h2>
    <?php if(!empty($categories)) { ?>
    <table class="table table-hover table-bordered" >
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
            <td><?= $category->getName() ?></td>
            <td style="width: 9%"><?= $category->count ?></td>
            <td style="width: 12%"><a class="btn btn-primary" href="news?catid=<?= $category->getId() ?>">List News</a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <div class="alert alert-warning">
            <strong>Oops!</strong> Nothing to show
        </div>
    <?php } ?>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT']."/template/footer.php");
?>