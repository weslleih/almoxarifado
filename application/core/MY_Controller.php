<?php
class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    protected function render($view,$data){
        $this->load->view("header", $data);
        $this->load->view($view, $data);
        $this->load->view("footer", $data);
    }
}
?>
