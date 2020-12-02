<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->verify_level(3);
    }
    public function index()	{
        $this->render('consumers',null);
    }

    public function users()	{
        $this->render('users',null);
    }
    public function forms()	{
        $this->render('forms',null);
    }

}
?>
