<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Congroups extends MY_Controller {
    public function index()	{
        $this->render('consumers-groups',null);
    }
    public function add()	{
        $this->load->view('modals/consumer-groups-add',null);
    }
    public function edit()	{
        $this->load->view('modals/consumer-groups-edit',null);
    }
}
?>
