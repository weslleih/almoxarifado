<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Groups extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("Group_model");
        $this->verify_level(2);
    }

    public function index()	{
        $this->load->library("pagination");
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["action"] = site_url("groups");

        $term = $this->input->post('term');

        $data["groups"] = $this->Group_model->get_list($page,20,$term);

        $config["base_url"] = site_url("groups/index");
        $config["total_rows"] = $this->Group_model->get_total($term);
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        if ($this->input->is_ajax_request()) {
            $this->load->view('tbodys/groups',$data);
        }else{
            $this->render('groups',$data);
        }
    }

    public function add()	{
        $data["action"] = site_url("groups/ajaxadd");
        $this->load->view("modals/group-form",$data);
    }

    public function edit($id)	{
        $group = $this->Group_model->get_by_id($id);
        if(!$group){
            $data["title"] = "Erro!";
            $data["message"] = "Fornecedor não encontrado!";
            $this->load->view("modals/error",$data);
            return;
        }

        $data["action"] = site_url("groups/ajaxedit/$id");



        $data["id"] = $group->id;
        $data["name"] = $group->name;

        $this->load->view("modals/group-form",$data);
    }

    public function ajaxadd()	{
        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("idgroup", "Código", "trim|is_unic[group.idgroup]|xss_clean");
        $this->form_validation->set_rules("name", "Razão Social", "trim|required|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $group = array("name" => $this->input->post("name"));

            if($this->input->post("idgroup") != ''){
                $group['id'] = $this->input->post("idgroup");
            }

            if($this->Group_model->add($group)){
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

        $group = $this->Group_model->get_by_id($id);
        if(!$group){
            $data->success = false;
            $error = new stdClass();
            $error->message = "Erro interno, problemas com o banco de dados.";
            $data->error = $error;
            $this->jsonoutput($data);
            return;
        }

        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("idgroup", "Código","trim|is_unic_edit[group.id,id.$id]|xss_clean");
        $this->form_validation->set_rules("name", "Razão Social", "trim|required|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $group = array("name" => $this->input->post("name"));

            if($this->input->post("idgroup") != ''){
                $group['id'] = $this->input->post("idgroup");
            }

            if($this->Group_model->update($id,$group)){
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
