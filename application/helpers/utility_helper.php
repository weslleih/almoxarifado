<?php
function asset_url($str){
    return base_url(). 'assets/' . $str;
}

function insert_input_value($conext,$var_name){
    if($conext->is_cached_var($var_name)){
        echo "value='".$conext->get_cached_var($var_name)."'";
    }
}

function insert_option_value($conext,$var_name,$value){
    if($conext->is_cached_var($var_name)){
        if($conext->get_cached_var($var_name) == $value){
            echo "selected";
        }
    }
}
?>
