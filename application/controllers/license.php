<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class License extends MY_Controller {
    public function index()	{
        $this->load->view('modals/license',null);
    }
}
?>
