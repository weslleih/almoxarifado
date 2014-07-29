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
                $this->db->where("(`product`.`name` LIKE  '%$search[term]%' OR CAST( `id` AS CHAR( 50 ) ) LIKE  '$search[term]%')");
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
                $this->db->where("(`product`.`name` LIKE  '%$search[term]%' OR CAST( `id` AS CHAR( 50 ) ) LIKE  '$search[term]%')");
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

}
?>
