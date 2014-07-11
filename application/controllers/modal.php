<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modal extends MY_Controller {
    public function index()
	{
		$this->render('index',null);
	}
    function newProduct(){
        $this->load->view("modals/newProduct");
    }

} ?>
