<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("Report_model");
        $this->load->model("Group_model");
        $this->verify_level(2);
    }

    public function index()	{
        $this->render('report',null);
    }

    function inout(){

        $datebeg = $this->input->post('datebeg')?convert_date($this->input->post('datebeg')):date('Y-m-d',strtotime("-1 month"));
        $dateend = $this->input->post('dateend')?convert_date($this->input->post('dateend')):date('Y-m-d');

        $this->load->library("pagination");
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config["base_url"] = site_url("report/inout");
        $config["total_rows"] = $this->Report_model->get_inout_total();
        $config["per_page"] = $limit = 20;
        $this->pagination->initialize($config);

        $data["groups"] = $this->Group_model->get_all();
        $data["action"] = site_url("repor/inout");


        $data["inouts"] = $this->Report_model->get_inout_list($page,$limit,$datebeg,$dateend);

        if ($this->input->is_ajax_request()) {
            $this->load->view('tbodys/report-inouts',$data);
        }else{
            $this->render('report-inouts',$data);
        }
    }
}
?>
