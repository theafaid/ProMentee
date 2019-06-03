<?php

if(!function_exists('create')){
    function create($className, $data = [], $count = null){
        return factory($className, $count)->create($data);
    }
}

if(!function_exists('make')){
    function make($className, $data = [], $count = null){
        return factory($className, $count)->make($data);
    }
}
