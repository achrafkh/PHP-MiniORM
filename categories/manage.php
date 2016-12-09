<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/Load.php");

if (Request::has("create")) {

    $cat = Category::Create(Request::only("name"));

    if (!$cat) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "Category Successfully Added"];
    }
}

if (Request::has("update")) {

    $cat = Category::Find(Request::get("id"))->Update(Request::only("name"));

    if (!$cat) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "Category Successfully Added"];
    }
}

if (Request::has("delete")) {

    if (!Category::Delete(Request::get("delete"))) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "Category Successfully Deleted"];
    }
}

header("Location: /categories");
