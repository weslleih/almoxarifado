<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Groups extends MY_Controller {
    public function index()	{
        $this->render('groups',null);
    }
    public function add()	{
        $this->load->view('modals/group-add',null);
    }
    public function edit()	{
        $this->load->view('modals/group-edit',null);
    }
}
?>
