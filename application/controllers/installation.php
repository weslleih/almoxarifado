<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Installation extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

	public function index(){
        if(file_exists(APPPATH."/config/database.php") || file_exists(APPPATH."/config/development/database.php")){
            redirect('/', 'refresh');
        }
        $this->load->library("form_validation");

        $this->form_validation->set_rules("dbuser", "Usuário", "trim|required|xss_clean");
        $this->form_validation->set_rules("dbpass", "Senha", "trim|required|xss_clean");
        $this->form_validation->set_rules("dbname", "Nome", "trim|required|xss_clean");

		if ($this->form_validation->run() == FALSE){
           $this->load->view("installation");
		}else{
            $dbtext = file_get_contents(APPPATH."/config/database_sample.php");
            $in = array("dbuser","dbpass","dbname");
            $out = array($this->input->post("dbuser"),$this->input->post("dbpass"),$this->input->post("dbname"));
            $dbtext = str_replace($in,$out,$dbtext);
            if(is_writable(APPPATH."/config/")){
                file_put_contents(APPPATH."/config/database.php",$dbtext);
                $create = $this->create_tables();
                if($create === true){
                    $this->load->view("installation");
                }else{
                    unlink(APPPATH."/config/database.php");
                    $data['error'] = $create;
                    $this->load->view("installation",$data);
                }
            }else{
                $data['databese_config'] = str_replace("\n","<br>",html_escape($dbtext));
                $this->load->view("installation",$data);
            }
		}
	}
    public function confirm(){
        if($this->create_tables()){

        }
    }
    private function create_tables($user,$pass,$db){

        $link = mysqli_connect('localhost', $user, $pass);
        if (!$link) {
            return "Usuário e/ou senha incorreto(s)";
        }

        $db_selected = mysqli_select_db($db, $link);
        if (!$db_selected) {
            return "Nome de banco de dados não encontrado";
        }

        mysql_close($link);

        $sql_string =   file_get_contents(FCPATH.APPPATH."installation/database.sql",true);
        $sql_array = explode(";\n", $sql_string);


        $this->load->database();
        foreach($sql_array as $sql){
                $query = $this->db->query($sql);
        }
        return true;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
