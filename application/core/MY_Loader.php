<?php
class MY_Loader extends CI_Loader {

    function __construct()
    {
        parent::__construct ();
    }
    public function is_cached_var($var_name){
        if(array_key_exists($var_name,$this->_ci_cached_vars)){
            return true;
        }else{
            return false;
        }

    }
    public function get_cached_var($var_name){
        return $this->_ci_cached_vars[$var_name];
    }
}
?>
