<?php
class Product_model extends MY_model {

    public function add($data){
        $this->db->insert("product",$data);
        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function update($id,$data){
        $this->db->where('id', $id);
        $this->db->update('product', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            $data['id'] = $id;
            $query = $this->db->get_where('product', $data);
            if ($query->num_rows() > 0){
                return true;
            }
        }
        return false;
    }

    public function get_list($start = 0, $limit = 20,$search){
        $this->db->order_by("product.name");
        $this->db->select('*, product.name AS name, group.name AS gname, product.id AS id, group.id AS gid', FALSE);
        $this->db->join('group', 'group.id = product.group');

        if($search["term"]){
            if(is_numeric($search["term"])){
                $this->db->where("(`product`.`name` LIKE  '%$search[term]%' OR CAST( `product`.`id` AS CHAR( 50 ) ) LIKE  '$search[term]%')");
            }else{
                $this->db->like("product.name",$search["term"]);
            }
        }

        if($search["group"]){
            $this->db->where("product.group",$search["group"]);
        }

        $query = $this->db->get('product', $limit, $start);
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function get_total($search){
        if(!$search["term"] && !$search["group"]){
            return $this->db->count_all('product');
        }

        $this->db->select('*, product.name AS name, group.name AS gname, product.id AS id, group.id AS gid', FALSE);
        $this->db->join('group', 'group.id = product.group');

        if($search["term"]){
            if(is_numeric($search["term"])){
                $this->db->where("(`product`.`name` LIKE  '%$search[term]%' OR CAST( `product`.`id` AS CHAR( 50 ) ) LIKE  '$search[term]%')");
            }else{
                $this->db->like("product.name",$search["term"]);
            }
        }
        if($search["group"]){
            $this->db->where("product.group",$search["group"]);
        }

        $query = $this->db->get('product');
        return $query->num_rows();

    }

    public function get_by_id($id){
        $query = $this->db->get_where('product', array('id' => $id), 1);
        if ($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function add_input($data){
        $this->db->trans_start();

        $this->db->select("quantity,value");
        $this->db->where('id', $data["product"]);
        $query = $this->db->get('product');
        if ($query->num_rows() > 0){

            $tot = $query->row()->quantity + $data["quantity"];
            $avg = (($query->row()->value*$query->row()->quantity)+($data["value"]*$data["quantity"]))/$tot;

            $this->update($data["product"],array("value" => $avg, "quantity" => $tot));
            $this->db->insert("productinput",$data);

            if($this->db->affected_rows() > 0){
                $this->db->trans_complete();
                return true;
            }
        }
        $this->db->trans_complete();
        return false;
    }
    public function remove_input($id){
        $this->db->trans_start();

        $this->db->select("*");
        $this->db->where('id', $id);
        $query = $this->db->get('productinput');
        if ($query->num_rows() > 0){
            $input = $query->row();
            $this->db->select("*");
            $this->db->where('id', $input->product);
            $query = $this->db->get('product');
            if ($query->num_rows() > 0){
                $product = $query->row();

                $tot = $product->quantity - $input->quantity;
                $avg = 0;
                if ($tot != 0) {
                    $avg = (($product->quantity*$product->value)-($input->quantity*$input->value))/ $tot;
                }

                $this->update($product->id,array("value" => $avg, "quantity" => $tot));
                $this->db->delete('productinput', array('id' => $id));
                if($this->db->affected_rows() > 0){
                    $this->db->trans_complete();
                    return true;
                }
            }
        }
        $this->db->trans_complete();
        return false;
    }

    public function add_output($data){
        $this->db->trans_start();

        $this->db->select("quantity,value");
        $this->db->where('id', $data["product"]);
        $query = $this->db->get('product');
        if ($query->num_rows() > 0){

            $tot = $query->row()->quantity - $data["quantity"];
            if($tot<0){
                return 830;
            }
            $product["quantity"] = $tot;

            $data["value"] = $query->row()->value;

            if($tot==0){
                $product["value"] = 0;
            }
            $this->update($data["product"],$product);

            $this->db->insert("productoutput",$data);
            if($this->db->affected_rows() > 0){
                $this->db->trans_complete();
                return true;
            }
        }
     $this->db->trans_complete();
     return false;
    }

    public function remove_output($id){
        $this->db->trans_start();

        $this->db->select("*");
        $this->db->where('id', $id);
        $query = $this->db->get('productoutput');
        if ($query->num_rows() > 0){
            $output = $query->row();
            $this->db->select("*");
            $this->db->where('id', $output->product);
            $query = $this->db->get('product');
            if ($query->num_rows() > 0){
                $product = $query->row();

                $tot = $product->quantity + $output->quantity;
                $avg = 0;
                if ($tot != 0) {
                    $avg = (($product->quantity*$product->value)+($output->quantity*$output->value))/ $tot;
                }

                $this->update($product->id,array("value" => $avg, "quantity" => $tot));
                $this->db->delete('productoutput', array('id' => $id));
                if($this->db->affected_rows() > 0){
                    $this->db->trans_complete();
                    return true;
                }
            }
        }
        $this->db->trans_complete();
        return false;
    }

    public function remove_immediate($id){
        $this->db->delete('productimmediate', array('id' => $id));
        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function add_immediate($data){
        $this->db->insert("productimmediate",$data);
        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function get_input_list($start = 0, $limit = 20,$search){
        $this->db->order_by("registered", "desc");
        $this->db->select('*, provider.id AS pid, productinput.id AS id', FALSE);
        $this->db->join('provider', 'provider.id = productinput.provider');

        if($search["term"]){
            $this->db->like("provider.name",$search["term"]);
        }

        if($search["product"]){
            $this->db->where("product",$search["product"]);
        }

        $query = $this->db->get('productinput', $limit, $start);
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function get_inpu_total($search){
        if(!$search["term"] && !$search["product"]){
            return $this->db->count_all('product');
        }

        $this->db->order_by("registered", "desc");
        $this->db->select('*, provider.id AS pid, productinput.id AS id', FALSE);
        $this->db->join('provider', 'provider.id = productinput.provider');

        if($search["term"]){
            $this->db->like("provider.name",$search["term"]);
        }

        if($search["product"]){
            $this->db->where("product",$search["product"]);
        }

        return $this->db->count_all_results('productinput');

    }

    public function get_output_list($start = 0, $limit = 20,$search){
        $this->db->order_by("registered", "desc");
        $this->db->select('*, consumer.id AS cid, productoutput.id AS id', FALSE);
        $this->db->join('consumer', 'consumer.id = productoutput.consumer');

        if($search["term"]){
            $this->db->like("consumer.name",$search["term"]);
        }

        if($search["product"]){
            $this->db->where("product",$search["product"]);
        }

        $query = $this->db->get('productoutput', $limit, $start);
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function get_outpu_total($search){
        if(!$search["term"] && !$search["product"]){
            return $this->db->count_all('product');
        }

        $this->db->order_by("registered", "desc");
        $this->db->select('*, consumer.id AS pid, productoutput.id AS id', FALSE);
        $this->db->join('consumer', 'consumer.id = productoutput.consumer');

        if($search["term"]){
            $this->db->like("consumer.name",$search["term"]);
        }

        if($search["product"]){
            $this->db->where("product",$search["product"]);
        }

        return $this->db->count_all_results('productoutput');

    }

     public function get_immediate_list($start = 0, $limit = 20,$search){
        $this->db->order_by("registered", "desc");
        $this->db->select('*, consumer.name AS consumer, productimmediate.id AS id');
        $this->db->join('consumer', 'consumer.id = productimmediate.consumer');

        if($search["product"]){
            $this->db->where("product",$search["product"]);
        }

        $query = $this->db->get('productimmediate', $limit, $start);
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function get_immediate_total($search){
        if(!$search["product"]){
            return $this->db->count_all('product');
        }

        $this->db->order_by("registered", "desc");
        $this->db->select('*');
        $this->db->join('consumer', 'consumer.id = productimmediate.consumer');

        if($search["product"]){
            $this->db->where("product",$search["product"]);
        }

        return $this->db->count_all_results('productimmediate');

    }

}
?>
