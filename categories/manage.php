<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/Load.php");

if (isset($_POST["create"]) && $_POST["name"] != "") {

    $cat = Category::Create(["name" => $_POST["name"]]);



    if (!$cat) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "Category Successfully Added"];
    }
}

if (isset($_POST["update"]) && $_POST["name"] != "") {

    $cat = Category::Find($_POST["id"])->Update(["name" => $_POST["name"]]);

    if (!$cat) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "Category Successfully Added"];
    }
}

if (isset($_POST["delete"])) {

    if (!Category::Delete($_POST["delete"])) {


        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "Category Successfully Deleted"];
    }
}

header("Location: /categories");
