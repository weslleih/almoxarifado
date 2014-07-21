<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Admin extends MY_Controller {
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
