<?php
function asset_url($str){
    return base_url(). 'assets/' . $str;
}

function insert_input_value($conext,$var_name){
    if($conext->is_cached_var($var_name)){
        echo "value='".$conext->get_cached_var($var_name)."'";
    }
}

function insert_textarea_value($conext,$var_name){
    if($conext->is_cached_var($var_name)){
        echo $conext->get_cached_var($var_name);
    }
}

function insert_option_value($conext,$var_name,$value){
    if($conext->is_cached_var($var_name)){
        if($conext->get_cached_var($var_name) == $value){
            echo "selected";
        }
    }
}

function convert_date($date){
   if ( ! strstr( $date, '/' ) ){
        sscanf( $date, '%d-%d-%d', $y, $m, $d );
        return sprintf( '%d/%d/%d', $d, $m, $y );
    }else{
        sscanf( $date, '%d/%d/%d', $d, $m, $y );
        return sprintf( '%d-%d-%d', $y, $m, $d );
    }

    return false;
}
?>
