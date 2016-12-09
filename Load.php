<?php
/**
 * Created by PhpStorm.
 * User: pach
 * Date: 05/12/16
 * Time: 00:15
 */


require_once($_SERVER['DOCUMENT_ROOT']."/Entity/Category.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Entity/News.php");

require_once($_SERVER['DOCUMENT_ROOT']."/core/Request.php");

function dd($x)
{
    var_dump($x);
    exit();
}
function pr($x)
{
    print_r($x);
    exit();
}
