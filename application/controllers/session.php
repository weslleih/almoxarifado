<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Session extends MY_Controller {
    public function index()	{
        //$this->render('providers',null);
    }

    public function login()	{
        $this->load->view('modals/login',null);
    }
    public function logout()	{
        //$this->load->view('modals/provider-edit',null);
    }
}
?>
