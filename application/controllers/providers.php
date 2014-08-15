<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Providers extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("Provider_model");
        $this->verify_level(2);
    }

    public function index()	{
        $this->load->library("pagination");

        $data["action"] = site_url("providers");

        $term = $this->input->post('term');

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["providers"] = $this->Provider_model->get_list($page,20,$term);

        $config["base_url"] = site_url("providers/index");
        $config["total_rows"] = $this->Provider_model->get_total($term);
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        if ($this->input->is_ajax_request()) {
            $this->load->view('tbodys/providers',$data);
        }else{
            $this->render('providers',$data);
        }
    }

    public function add()	{
        $data["action"] = site_url("providers/ajaxadd");
        $this->load->view("modals/provider-form",$data);
    }

    public function edit($id)	{
        $provider = $this->Provider_model->get_by_id($id);
        if(!$provider){
            $data["title"] = "Erro!";
            $data["message"] = "Fornecedor não encontrado!";
            $this->load->view("modals/error",$data);
            return;
        }

        $data["action"] = site_url("providers/ajaxedit/$id");



        $data["idprovider"] = $provider->id;
        $data["name"] = $provider->name;
        $data["document"] = $provider->document;
        $data["email"] = $provider->email;
        $data["phone1"] = $provider->phone1;
        $data["phone1resp"] = $provider->phone1resp;
        $data["phone2"] = $provider->phone2;
        $data["phone2resp"] = $provider->phone2resp;
        $data["address"] = $provider->address;

        $this->load->view("modals/provider-form",$data);
    }

    public function ajaxadd()	{
        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("idprovider", "Código", "trim|is_unic[provider.idprovider]|xss_clean");
        $this->form_validation->set_rules("name", "Razão Social", "trim|required|xss_clean");
        $this->form_validation->set_rules("document", "CPF/CNPJ", "trim|required|is_unic[provider.document]|xss_clean");
        $this->form_validation->set_rules("email", "Email", "trim|valid_email|xss_clean");
        $this->form_validation->set_rules("phone1", "Telefone", "trim|xss_clean");
        $this->form_validation->set_rules("phone1resp", "Responsável", "trim|xss_clean");
        $this->form_validation->set_rules("phone2", "Telefone", "trim|xss_clean");
        $this->form_validation->set_rules("phone2resp", "Respnsável", "trim|xss_clean");
        $this->form_validation->set_rules("address", "Endereço", "trim|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $provider = array("name" => $this->input->post("name"),
                         "document" => $this->input->post("document"),
                         "email" => $this->input->post("email"),
                         "phone1" => $this->input->post("phone1"),
                         "phone1resp" => $this->input->post("phone1resp"),
                         "phone2" => $this->input->post("phone2"),
                         "phone2resp" => $this->input->post("phone2resp"),
                         "address" => $this->input->post("address"));

            if($this->input->post("idprovider") != ''){
                $provider['id'] = $this->input->post("idprovider");
            }

            if($this->Provider_model->add($provider)){
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

        $provider = $this->Provider_model->get_by_id($id);
        if(!$provider){
            $data->success = false;
            $error = new stdClass();
            $error->message = "Erro interno, problemas com o banco de dados.";
            $data->error = $error;
            $this->jsonoutput($data);
            return;
        }

        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("idprovider", "Código","trim|is_unic_edit[provider.idprovider,idprovider.$id]|xss_clean");
        $this->form_validation->set_rules("name", "Razão Social", "trim|required|xss_clean");
        $this->form_validation->set_rules("document", "CPF/CNPJ", "trim|required|is_unic_edit[provider.document,idprovider.$id]|xss_clean");
        $this->form_validation->set_rules("email", "Email", "trim|xss_clean");
        $this->form_validation->set_rules("phone1", "Telefone", "trim|xss_clean");
        $this->form_validation->set_rules("phone1resp", "Responsável", "trim|xss_clean");
        $this->form_validation->set_rules("phone2", "Telefone", "trim|xss_clean");
        $this->form_validation->set_rules("phone2resp", "Respnsável", "trim|xss_clean");
        $this->form_validation->set_rules("address", "Endereço", "trim|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $provider = array("name" => $this->input->post("name"),
                         "document" => $this->input->post("document"),
                         "email" => $this->input->post("email"),
                         "phone1" => $this->input->post("phone1"),
                         "phone1resp" => $this->input->post("phone1resp"),
                         "phone2" => $this->input->post("phone2"),
                         "phone2resp" => $this->input->post("phone2resp"),
                         "address" => $this->input->post("address"));

            if($this->input->post("idprovider") != ''){
                $provider['id'] = $this->input->post("idprovider");
            }

            if($this->Provider_model->update($id,$provider)){
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
