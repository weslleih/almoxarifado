<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Users extends MY_Controller {
    public function index()	{
        $this->render('users',null);
    }
    public function add()	{
        $this->load->view('modals/user-add',null);
    }
    public function edit()	{
        $this->load->view('modals/user-edit',null);
    }
}
?>
