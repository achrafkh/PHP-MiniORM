<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/Load.php");

if (isset($_POST["create"]) && $_POST["title"] != "" && $_POST["description"] != "" && $_POST["category_id"] != "") {
    unset($_POST["create"]);
    $data = $_POST;
    $news = News::Create($data);

    if (!$news) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "News Successfully Added"];
    }
}

if (isset($_POST["update"])) {

    $data = $_POST;
    $id = $data["id"];


    unset($data["id"]);
    unset($data["update"]);

    if ($data["title"] == "") {
        unset($data["title"]);
    }
    if ($data["description"] == "") {
        unset($data["description"]);
    }
    if ($data["category_id"] == "") {
        unset($data["category_id"]);
    }

    $news = News::Find($id)->Update($data);

    if (!$news) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "News Successfully Added"];
    }
}

if (isset($_POST["delete"])) {
    if (!News::Delete($_POST["delete"])) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "News Successfully Deleted"];
    }
}

header("Location: /news");
