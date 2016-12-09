<?php

class Request
{
    public static function get($key){
        if(isset($_REQUEST[$key])){
            return $_REQUEST[$key];
        }
        return null;
    }

    public static function only(){
        $args = func_get_args();
        $inputs = null;
        foreach($args as $key => $v){
            $inputs[$v] = $_REQUEST[$v];
        }
        return $inputs;
    }

    public static function except(){
        $args = func_get_args();
        $inputs = null;
        if(isset($_REQUEST)){
            foreach($_REQUEST as $key => $value){
                if($value != ""){
                    if(!in_array($key,$args)){
                        $inputs[$key] = $value;
                    }

                }
            }
        }
        return $inputs;
    }

    public static function has($key){
        $rs = false;
        if(isset($_REQUEST[$key])){
            if($_REQUEST[$key] != ""){
                $rs = true;
            };
        }

        return $rs;
    }

    public static function all(){
        $inputs = null;
        if(isset($_REQUEST)){
            foreach($_REQUEST as $key => $value){
                if($value != ""){
                    $inputs[$key] = $value;
                }
            }
        }

        return $inputs;
    }

    public static function validate(){
        $args = func_get_args();
        $inputs = null;
            foreach($_REQUEST as $key => $value){
                if($value != ""){
                    $inputs[$key] = $value;
            }
        }
        return $inputs;
    }
}