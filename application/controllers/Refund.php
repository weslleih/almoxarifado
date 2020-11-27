<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Refund extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("Product_model");
        $this->verify_level(2);
    }

    public function index()	{

        $this->load->library("pagination");
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["action"] = site_url("products");

        $search = array("term" => $term = $this->input->post('term'),
                        "group" =>$term = $this->input->post('group'));

        $data["products"] = $this->Product_model->get_list($page,20,$search);

        $config["base_url"] = site_url("products/index");
        $config["total_rows"] = $this->Product_model->get_total($search);
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        $data["groups"] = $this->Group_model->get_all();

        if ($this->input->is_ajax_request()) {
            $this->load->view('tbodys/products',$data);
        }else{
            $this->render('products',$data);
        }
    }


    public function input($id)	{

        $this->load->library("pagination");
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $search['term'] = $this->input->post('term');
        $search['product'] = $id;

        $data["target"] = site_url("refund/ajaxinput/$id");
        $data["action"] = site_url("refund/input/$id");

        $data["productinputs"] = $this->Product_model->get_input_list($page,20,$search);

        $config["base_url"] = site_url("refund/input");
        $config["total_rows"] = $this->Product_model->get_inpu_total($search);
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        if ($this->input->is_ajax_request()) {
             $this->load->view('tbodys/refund-input',$data);
        }else{
            $this->render('refund-input',$data);
        }
    }

    public function output($id)	{

        $this->load->library("pagination");
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $search['term'] = $this->input->post('term');
        $search['product'] = $id;

        $data["target"] = site_url("refund/ajaxoutput/$id");
        $data["action"] = site_url("refund/output/$id");

        $data["productoutputs"] = $this->Product_model->get_output_list($page,20,$search);

        $config["base_url"] = site_url("refund/output");
        $config["total_rows"] = $this->Product_model->get_outpu_total($search);
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        if ($this->input->is_ajax_request()) {
             $this->load->view('tbodys/refund-output',$data);
        }else{
            $this->render('refund-output',$data);
        }
    }

    public function immediate($id)	{

        $this->load->library("pagination");
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $search['product'] = $id;

        $data["target"] = site_url("refund/ajaximmediate/$id");

        $data["productimmediates"] = $this->Product_model->get_immediate_list($page,20,$search);

        $config["base_url"] = site_url("refund/immediate");
        $config["total_rows"] = $this->Product_model->get_immediate_total($search);
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        if ($this->input->is_ajax_request()) {
             $this->load->view('tbodys/refund-immediate',$data);
        }else{
            $this->render('refund-immediate',$data);
        }
    }

    public function ajaxinput($id){
        if($this->input->post('verification')){
            $data = new stdClass();
            if($this->Product_model->remove_input($id)){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                $error->message = "Erro interno, problemas com o banco de dados.";
                $data->error = $error;
            }
            $this->jsonoutput($data);
        }else{
            $data["action"] = site_url("refund/ajaxinput/$id");
            $data["title"] = "Confirmação!";
            $data["message"] = "Tem certeza que deseja estornar a entrada de código <strong>$id</strong>?";

            $this->load->view('modals/dialog',$data);
        }
    }

    public function ajaxoutput($id){
        if($this->input->post('verification')){
            $data = new stdClass();
            if($this->Product_model->remove_output($id)){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                $error->message = "Erro interno, problemas com o banco de dados.";
                $data->error = $error;
            }
            $this->jsonoutput($data);
        }else{
            $data["action"] = site_url("refund/ajaxoutput/$id");
            $data["title"] = "Confirmação!";
            $data["message"] = "Tem certeza que deseja estornar a saída de código <strong>$id</strong>?";

            $this->load->view('modals/dialog',$data);
        }

    }

    public function ajaximmediate($id){
        if($this->input->post('verification')){
            $data = new stdClass();
            if($this->Product_model->remove_immediate($id)){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                $error->message = "Erro interno, problemas com o banco de dados.";
                $data->error = $error;
            }
            $this->jsonoutput($data);
        }else{
            $data["action"] = site_url("refund/ajaximmediate/$id");
            $data["title"] = "Confirmação!";
            $data["message"] = "Tem certeza que deseja estornar a saída de código <strong>$id</strong>?";

            $this->load->view('modals/dialog',$data);
        }

    }
}
