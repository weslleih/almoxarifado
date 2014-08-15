<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

    class Users extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("User_model");
        $this->verify_level(3);
    }
    public function index()	{
        $this->load->library("pagination");
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["users"] = $this->User_model->get_list($page);

        $config["base_url"] = site_url("users/index");
        $config["total_rows"] = $this->User_model->get_total();
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        $this->render("users",$data);
    }
    public function add()	{
        $data["action"] = site_url("users/ajaxadd");
        $this->load->view("modals/user-form",$data);
    }

    public function edit($id)	{
        $user = $this->User_model->get_by_id($id);
        if(!$user){
            $data["title"] = "Erro!";
            $data["message"] = "Usuário não encontrado!";
            $this->load->view("modals/error",$data);
            return;
        }

        $data["action"] = site_url("users/ajaxedit/$id");



        $data["name"] = $user->name;
        $data["login"] = $user->login;
        $data["level"] = $user->level;

        $this->load->view("modals/user-form",$data);
    }

    public function ajaxadd()	{
        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("name", "Nome", "trim|required|xss_clean");
		$this->form_validation->set_rules("password", "Senha", "required|sha1");
        $this->form_validation->set_rules("password2", "Confirmação", "required|matches[password]");
		$this->form_validation->set_rules("login", "Login", "trim|required|is_unique[user.login]|xss_clean");
        $this->form_validation->set_rules("level", "Nível", "trim|required|xss_clean");
        $this->form_validation->set_rules("active", "Ativo", "trim|required|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $user = array("name" => $this->input->post("name"),
                         "password" => $this->input->post("password"),
                         "login" => $this->input->post("login"),
                         "active" => $this->input->post("active"),
                         "level" => $this->input->post("level"));

            if($this->User_model->add($user)){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                $error->message = "Erro interno, problemas com o banco de dados.";
                $data->error = $error;
            }
		}
        $this->jsonoutput($data);
    }

    public function ajaxedit($id)	{
        $user = $this->User_model->get_by_id($id);
        if(!$user){
            $data->success = false;
            $error = new stdClass();
            $error->message = "Erro interno, problemas com o banco de dados.";
            $data->error = $error;
            $this->jsonoutput($data);
            return;
        }


        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("name", "Nome", "trim|required|xss_clean");
		$this->form_validation->set_rules("password", "Senha", "sha1");
        $this->form_validation->set_rules("password2", "Confirmação", "matches[password]");
		$this->form_validation->set_rules("login", "Login", "trim|required|is_unique_edit[user.login,iduser.$id]|xss_clean");
        $this->form_validation->set_rules("level", "Nível", "trim|required|xss_clean");
        $this->form_validation->set_rules("active", "Ativo", "trim|required|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $user = array("name" => $this->input->post("name"),
                          "login" => $this->input->post("login"),
                          "active" => $this->input->post("active"),
                          "level" => $this->input->post("level"));

            if($this->input->post("password") != ''){
                $user['password'] = $this->input->post("password");
            }
            if($this->User_model->update($id,$user)){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                $error->message = "Erro interno, problemas com o banco de dados.";
                $data->error = $error;
            }
		}
        $this->jsonoutput($data);
    }
}
?>
