<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Controller {
     function __construct() {
        parent::__construct();
        $this->load->model("User_model");
        $this->load->library('session');
    }
    public function index()	{
    }

    public function login()	{

        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("login", "Login", "trim|required|callback_login_check[".$this->input->post('password')."]|xss_clean");
        $this->form_validation->set_rules("password", "Senha", "trim|required|xss_clean");

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

        if ($this->form_validation->run() == TRUE){
            $user = $this->User_model->get_by_login($this->input->post("login"));
            $newdata = array(
               'userid'  => $user->id,
               'level'     => $user->level
            );
            $this->session->set_userdata($newdata);
            redirect('/', 'refresh');
        }

        $this->load->view('login',null);
    }
    public function logout()	{
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

    public function login_check($login,$password){
        $loged = $this->User_model->login($login, sha1($password));
		if ($loged == 2){
            return TRUE;
        }elseif($loged == 1){
			$this->form_validation->set_message('login_check', 'Usuário desativado');
			return FALSE;
        }else{
            $this->form_validation->set_message('login_check', 'Login e/ou senha incorretos');
			return FALSE;
        }
	}
}
?>
