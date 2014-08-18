<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("Product_model");
        $this->load->model("Group_model");
    }

    public function index()	{
        $this->verify_level(array(1,2,3));
        $this->load->library("pagination");
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["action"] = site_url("products");

        $search = array("term" => $term = $this->input->post('term'),
                        "group" => $term = $this->input->post('group'));

        $data["products"] = $this->Product_model->get_list($page,20,$search);

        $config["base_url"] = site_url("products/index");
        $config["total_rows"] = $this->Product_model->get_total($search);
        $config["per_page"] = 20;

        $this->pagination->initialize($config);

        $data["groups"] = $this->Group_model->get_all();

        if ($this->input->is_ajax_request()) {
            $this->load->view('tbodys/products',$data);
        }else{
            $this->render('products',$data);
        }
    }

    public function add()	{
        $this->verify_level(2);
        $data["action"] = site_url("products/ajaxadd");
        $data["groups"] = $this->Group_model->get_all();
        $this->load->view("modals/product-form",$data);
    }

    public function edit($id)	{
        $this->verify_level(2);
        $product = $this->Product_model->get_by_id($id);
        if(!$product){
            $data["title"] = "Erro!";
            $data["message"] = "Produto não encontrado!";
            $this->load->view("modals/error",$data);
            return;
        }

        $data["action"] = site_url("products/ajaxedit/$id");

        $data["groups"] = $this->Group_model->get_all();

        $data["id"] = $product->id;
        $data["name"] = $product->name;
        $data["group"] = $product->group;
        $data["unit"] = $product->unit;
        $data["maxinvent"] = $product->maxinvent;
        $data["mininvent"] = $product->mininvent;
        $data["catmat"] = $product->catmat;
        $data["observation"] = $product->observation;

        $this->load->view("modals/product-form",$data);
    }

    function input($id){
        $this->verify_level(2);
        $this->load->model("Provider_model");
        $product = $this->Product_model->get_by_id($id);
        if(!$product){
            $data["title"] = "Erro!";
            $data["message"] = "Produto não encontrado!";
            $this->load->view("modals/error",$data);
            return;
        }

        $data["action"] = site_url("products/ajaxinput/$id");

        $data["id"] = $product->id;
        $data["name"] = $product->name;
        $data["unit"] = $product->unit;

        $data['providers'] = $this->Provider_model->get_all();

        $this->load->view("modals/product-input",$data);
    }

    function output($id){
        $this->verify_level(2);
        $this->load->model("Consumer_model");
        $product = $this->Product_model->get_by_id($id);
        if(!$product){
            $data["title"] = "Erro!";
            $data["message"] = "Produto não encontrado!";
            $this->load->view("modals/error",$data);
            return;
        }

        $data["action"] = site_url("products/ajaxoutput/$id");

        $data["id"] = $product->id;
        $data["name"] = $product->name;
        $data["unit"] = $product->unit;
        $data["value"] = $product->value;

        $data['consumers'] = $this->Consumer_model->get_all();

        $this->load->view("modals/product-output",$data);
    }

    function immediate($id){
        $this->verify_level(2);
        $this->load->model("Consumer_model");
        $this->load->model("Provider_model");
        $product = $this->Product_model->get_by_id($id);
        if(!$product){
            $data["title"] = "Erro!";
            $data["message"] = "Produto não encontrado!";
            $this->load->view("modals/error",$data);
            return;
        }

        $data["action"] = site_url("products/ajaximmediate/$id");

        $data["id"] = $product->id;
        $data["name"] = $product->name;
        $data["unit"] = $product->unit;

        $data['consumers'] = $this->Consumer_model->get_all();
        $data['providers'] = $this->Provider_model->get_all();

        $this->load->view("modals/product-immediate",$data);
    }

    public function ajaxadd()	{
        $this->verify_level(2);
        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("idproduct", "Código", "trim|is_unic[product.idproduct]|xss_clean");
        $this->form_validation->set_rules("name", "Nome", "trim|required|xss_clean");
        $this->form_validation->set_rules("idgroup", "Grupo", "trim|required|xss_clean");
        $this->form_validation->set_rules("unit", "Unidade", "trim|required|xss_clean");
        $this->form_validation->set_rules("maxinvent", "Estoque Máximo ", "trim|xss_clean");
        $this->form_validation->set_rules("mininvent", "Estoque Mínimo", "trim|xss_clean");
        $this->form_validation->set_rules("catmat", "CatMat", "trim|xss_clean");
        $this->form_validation->set_rules("observation", "Observações", "trim|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $product = array("name" => $this->input->post("name"),
                         "group" => $this->input->post("idgroup"),
                         "unit" => $this->input->post("unit"),
                         "maxinvent" => $this->input->post("maxinvent"),
                         "mininvent" => $this->input->post("mininvent"),
                         "catmat" => $this->input->post("catmat"),
                         "observation" => $this->input->post("observation"));

            if($this->input->post("idproduct") != ''){
                $product['id'] = $this->input->post("idproduct");
            }

            if($this->Product_model->add($product)){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                $error->message = "Erro interno, problemas com o banco de dados.";
                $data->error = $error;
            }
		}
        $this->jsonoutput($data);
    }

    public function ajaxedit($id)	{
        $this->verify_level(2);
        $product = $this->Product_model->get_by_id($id);
        if(!$product){
            $data->success = false;
            $error = new stdClass();
            $error->message = "Erro interno, problemas com o banco de dados.";
            $data->error = $error;
            $this->jsonoutput($data);
            return;
        }

        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("idproduct", "Código","trim|is_unic_edit[product.id,id.$id]|xss_clean");
        $this->form_validation->set_rules("name", "Nome", "trim|required|xss_clean");
        $this->form_validation->set_rules("idgroup", "Grupo", "trim|required|xss_clean");
        $this->form_validation->set_rules("unit", "Unidade", "trim|required|xss_clean");
        $this->form_validation->set_rules("maxinvent", "Estoque Máximo ", "trim|xss_clean");
        $this->form_validation->set_rules("mininvent", "Estoque Mínimo", "trim|xss_clean");
        $this->form_validation->set_rules("catmat", "CatMat", "trim|xss_clean");
        $this->form_validation->set_rules("observation", "Observações", "trim|xss_clean");

        $this->form_validation->set_message("is_unique", "%s já está cadastrado no sistema");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $product = array("name" => $this->input->post("name"),
                         "group" => $this->input->post("idgroup"),
                         "unit" => $this->input->post("unit"),
                         "maxinvent" => $this->input->post("maxinvent"),
                         "mininvent" => $this->input->post("mininvent"),
                         "catmat" => $this->input->post("catmat"),
                         "observation" => $this->input->post("observation"));

            if($this->input->post("idproduct") != ''){
                $product['id'] = $this->input->post("idproduct");
            }

            if($this->Product_model->update($id,$product)){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                $error->message = "Erro interno, problemas com o banco de dados.";
                $data->error = $error;
            }
		}
        $this->jsonoutput($data);
    }

    public function ajaxinput($id)	{
        $this->verify_level(2);
        $product = $this->Product_model->get_by_id($id);
        if(!$product){
            $data->success = false;
            $error = new stdClass();
            $error->message = "Erro interno, problemas com o banco de dados.";
            $data->error = $error;
            $this->jsonoutput($data);
            return;
        }

        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("provider", "Fornecedor","trim|required|xss_clean");
        $this->form_validation->set_rules("date", "Data", "trim|required|xss_clean");
        $this->form_validation->set_rules("quantity", "Quantidade", "trim|required|xss_clean");
        $this->form_validation->set_rules("value", "Valor unitário", "trim|required|max_length[10]|callback_valid_brl|xss_clean");
        $this->form_validation->set_rules("empenho", "Empenho", "trim|xss_clean");
        $this->form_validation->set_rules("empenhodate", "Data do empenho", "trim|xss_clean");
        $this->form_validation->set_rules("fiscnote", "Nota fiscal ", "trim|xss_clean");
        $this->form_validation->set_rules("fiscnotedate", "Data da nota fiscal", "trim|xss_clean");
        $this->form_validation->set_rules("obs", "Observações", "trim|xss_clean");

        $this->form_validation->set_message("valid_brl", "%s não é um valor de moéda válido");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $product = array("product" => $id,
                             "provider" => $this->input->post("provider"),
                             "date" => convert_date($this->input->post("date")),
                             "quantity" => $this->input->post("quantity"),
                             "value" => (float)str_replace(",", ".",$this->input->post("value")),
                             "empenho" => $this->input->post("empenho"),
                             "empenhodate" => convert_date($this->input->post("empenhodate")),
                             "fiscnote" => $this->input->post("fiscnote"),
                             "fiscnotedate" => convert_date($this->input->post("fiscnotedate")),
                             "obs" => $this->input->post("obs"),
                             "user" => $this->session->userdata('userid'));

            if($this->Product_model->add_input($product)){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                $error->message = "Erro interno, problemas com o banco de dados.";
                $data->error = $error;
            }
		}
        $this->jsonoutput($data);
    }

    public function ajaxoutput($id)	{
        $this->verify_level(2);
        $product = $this->Product_model->get_by_id($id);
        if(!$product){
            $data->success = false;
            $error = new stdClass();
            $error->message = "Erro interno, problemas com o banco de dados.";
            $data->error = $error;
            $this->jsonoutput($data);
            return;
        }

        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("consumer", "Consumidor","trim|required|xss_clean");
        $this->form_validation->set_rules("responsible", "Recebente", "trim|required|xss_clean");
        $this->form_validation->set_rules("date", "Data", "trim|xss_clean");
        $this->form_validation->set_rules("quantity", "Quantidade", "trim|xss_clean");
        $this->form_validation->set_rules("document", "Nota fiscal ", "trim|xss_clean");

        $this->form_validation->set_message("callback_valid_brl", "%s não é um valor de moéda válido");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $product = array("product" => $id,
                             "consumer" => $this->input->post("consumer"),
                             "responsible" => $this->input->post("responsible"),
                             "quantity" => $this->input->post("quantity"),
                             "date" => convert_date($this->input->post("date")),
                             "document" => $this->input->post("document"),
                             "user" => $this->session->userdata('userid'));
            $resul = $this->Product_model->add_output($product);
            if($resul === true){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                if($resul == 830){
                    $error->message = "Estoque insuficiente.";
                }else{
                    $error->message = "Erro interno, problemas com o banco de dados.";
                }
                $data->error = $error;
            }
		}
        $this->jsonoutput($data);
    }

    public function ajaximmediate($id)	{
        $this->verify_level(2);
        $product = $this->Product_model->get_by_id($id);
        if(!$product){
            $data->success = false;
            $error = new stdClass();
            $error->message = "Erro interno, problemas com o banco de dados.";
            $data->error = $error;
            $this->jsonoutput($data);
            return;
        }

        $this->load->helper(array("form", "url"));
		$this->load->library("form_validation");

        $this->form_validation->set_rules("provider", "Fornecedor","trim|xss_clean");
        $this->form_validation->set_rules("date", "Data", "trim|required|xss_clean");
        $this->form_validation->set_rules("consumer", "Consumidor","trim|required|xss_clean");
        $this->form_validation->set_rules("responsible", "Recebente", "trim|required|xss_clean");
        $this->form_validation->set_rules("document", "Nota fiscal ", "trim|xss_clean");
        $this->form_validation->set_rules("quantity", "Quantidade", "trim|required|xss_clean");
        $this->form_validation->set_rules("value", "Valor unitário", "trim|required|max_length[10]|callback_valid_brl|xss_clean");
        $this->form_validation->set_rules("fiscnote", "Nota fiscal ", "trim|xss_clean");
        $this->form_validation->set_rules("fiscnotedate", "Data da nota fiscal", "trim|xss_clean");
        $this->form_validation->set_rules("obs", "Observações", "trim|xss_clean");

        $this->form_validation->set_message("valid_brl", "%s não é um valor de moéda válido");

        $data = new stdClass();

		if ($this->form_validation->run() == FALSE){
            $data->success = false;

            $data->error = $this->form_validation->error_array();;
		}else{
            $immediate = array("product" => $id,
                             "provider" => $this->input->post("provider")?$this->input->post("provider"):null,
                             "consumer" => $this->input->post("consumer"),
                             "responsible" => $this->input->post("responsible"),
                             "document" => $this->input->post("document"),
                             "date" => convert_date($this->input->post("date")),
                             "quantity" => $this->input->post("quantity"),
                             "value" => (float)str_replace(",", ".",$this->input->post("value")),
                             "fiscnote" => $this->input->post("fiscnote"),
                             "fiscnotedate" => convert_date($this->input->post("fiscnotedate")),
                             "obs" => $this->input->post("obs"),
                             "user" => $this->session->userdata('userid'));

            if($this->Product_model->add_immediate($immediate)){
                $data->success = true;
            }else{
                $data->success = false;
                $error = new stdClass();
                $error->message = "Erro interno, problemas com o banco de dados.";
                $data->error = $error;
            }
		}
        $this->jsonoutput($data);
    }

    public function valid_brl($str){
        if (preg_match('/[0-9]+\,[0-9]{2}/', $str)){
            return true; // it matched, return true or false if you want opposite
        }else{
            return false;
        }
    }
}
?>
