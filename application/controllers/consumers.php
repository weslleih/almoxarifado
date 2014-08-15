<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Consumers extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("Consumer_model");
        $this->verify_level(2);
    }

    public function index()	{
        $this->load->library("pagination");
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["action"] = site_url("consumers");

        $term = $this->input->post('term');

        $data["consumers"] = $this->Consumer_model->get_list($page,20,$term);

        $config["base_url"] = site_url("consumers/index");
        $config["total_rows"] = $this->Consumer_model->get_total($term);
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        if ($this->input->is_ajax_request()) {
            $this->load->view('tbodys/consumers',$data);
        }else{
            $this->render('consumers',$data);
        }
    }

    public function add()	{
        $data["action"] = site_url("consumers/ajaxadd");
        $this->load->view("modals/consumer-form",$data);
    }

    public function edit($id)	{
        $consumer = $this->Consumer_model->get_by_id($id);
        if(!$consumer){
            $data["title"] = "Erro!";
            $data["message"] = "Fornecedor não encontrado!";
            $this->load->view("modals/error",$data);
            return;
        }

        $data["action"] = site_url("consumers/ajaxedit/$id");

        $data["idconsumer"] = $consumer->id;
        $data["name"] = $consumer->name;

        $this->load->view("modals/consumer-form",$data);
    }

    public function ajaxadd()	{
        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("idconsumer", "Código", "trim|is_unic[consumer.idconsumer]|xss_clean");
        $this->form_validation->set_rules("name", "Nome", "trim|required|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $consumer = array("name" => $this->input->post("name"));

            if($this->input->post("idconsumer") != ''){
                $consumer['idconsumer'] = $this->input->post("idconsumer");
            }

            if($this->Consumer_model->add($consumer)){
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

        $consumer = $this->Consumer_model->get_by_id($id);
        if(!$consumer){
            $data->success = false;
            $error = new stdClass();
            $error->message = "Erro interno, problemas com o banco de dados.";
            $data->error = $error;
            $this->jsonoutput($data);
            return;
        }

        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("idconsumer", "Código","trim|is_unic_edit[consumer.idconsumer,idconsumer.$id]|xss_clean");
        $this->form_validation->set_rules("name", "Nome", "trim|required|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $consumer = array("name" => $this->input->post("name"));

            if($this->input->post("idconsumer") != ''){
                $consumer['id'] = $this->input->post("idconsumer");
            }

            if($this->Consumer_model->update($id,$consumer)){
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
