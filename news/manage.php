<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/Load.php");

if (Request::has("create")){
    $news = News::Create(Request::except("create"));

    if (!$news) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "News Successfully Added"];
    }
}

if (Request::has("update")) {
    $id = Request::get("id");

    $data = Request::only("title","description","category_id");

    $news = News::Find($id)->Update($data);

    if (!$news) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "News Successfully Added"];
    }
}

if (Request::has("delete")) {
    if (!News::Delete(Request::get("delete"))) {
        $_SESSION["msg"] = ["danger" => "something Went Wrong"];
    } else {
        $_SESSION["msg"] = ["success" => "News Successfully Deleted"];
    }
}

header("Location: /news");
