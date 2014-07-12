<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Consumers extends MY_Controller {
    public function index()	{
        $this->render('Consumers',null);
    }

            public function add()	{
        $this->load->view('modals/consumer-add',null);
    }
    public function edit()	{
        $this->load->view('modals/consumer-edit',null);
    }
}
?>
