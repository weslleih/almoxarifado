<?php
class MY_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        if(!$this->session->userdata('level')){
            redirect('/session/login', 'refresh');
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

    protected function verify_level($level){
        if(is_array($level)){
            foreach($level as $lv){
                if($lv == $this->session->userdata('level')){
                    return;
                }
            }
        }else{
            if($level == $this->session->userdata('level')){
                return;
            }
        }
        redirect('/', 'refresh');
    }
}
?>
