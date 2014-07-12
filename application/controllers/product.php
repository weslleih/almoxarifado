<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Product extends MY_Controller {
    public function index()	{
        //$this->load->view('modals/license',null);
    }

    function add(){
        $this->load->view("modals/product-add");
    }

    function input($id_product){
        $this->load->view("modals/product-input");
    }

    function output($id_product){
        $this->load->view("modals/product-output");
    }

    function reversein($id_product){
        $this->load->view("modals/product-output");
    }

    function reverseout($id_product){
        $this->load->view("modals/product-input");
    }
}
?>
