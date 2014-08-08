<?php
class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        if(!file_exists(APPPATH."/config/database.php") && !file_exists(APPPATH."/config/development/database.php")){
            redirect('/installation', 'refresh');
        }
    }
    protected function render($view,$data){
        $this->load->view("header", $data);
        $this->load->view($view, $data);
        $this->load->view("footer", $data);
    }
    protected function jsonoutput($data){
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }
}
?>
