<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Providers extends MY_Controller {
    public function index()	{
        $this->render('providers',null);
    }

    public function add()	{
        $this->load->view('modals/provider-add',null);
    }
    public function edit()	{
        $this->load->view('modals/provider-edit',null);
    }
}
?>
