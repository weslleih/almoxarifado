<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Refund extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("Product_model");
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

        $data["products"] = $this->Product_model->get_input_list($id,$page,20,$this->input->post('term'));

        $config["base_url"] = $data["action"] = site_url("refund/input");
        $config["total_rows"] = $this->Product_model->get_total-input($id,$search);
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

        $data["products"] = $this->Product_model->get_input_list($id,$page,20,$this->input->post('term'));

        $config["base_url"] = $data["action"] = site_url("refund/output");
        $config["total_rows"] = $this->Product_model->get_total-input($id,$search);
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        if ($this->input->is_ajax_request()) {
            $this->load->view('tbodys/refund-output',$data);
        }else{
            $this->render('refund-output',$data);
        }
    }
}
