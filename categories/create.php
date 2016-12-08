<?php
include($_SERVER['DOCUMENT_ROOT']."/template/head.php");
?>

<div class="container" style="width: 60%">
    <h2>Add A New Category </h2>

    <form method="POST" action="manage.php">
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <button type="submit" name="create" class="btn btn-default">Submit</button>
    </form>
</div>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.js"></script>
</body>
</html>

<?php
include($_SERVER['DOCUMENT_ROOT']."/template/footer.php");
?>