<?php class Report_model extends MY_model {

    public function get_inout_list($start,$limit,$datebeg, $dateend){
        $this->db->select("group.id,group.name");
        $this->db->select("SUM(COALESCE(`productinput`.`value` * `productinput`.`quantity`, 0)) AS `value`", false);
        $this->db->from("group");
        $this->db->join("product", "product.group = group.id","left");
        $this->db->join("productinput", "productinput.product = product.id AND productinput.date BETWEEN '$datebeg' AND '$dateend'","left");
        $this->db->group_by("group.id");
        $this->db->order_by("group.id");
        $this->db->limit($limit,$start);
        $input = $this->db->get();

        $this->db->select("group.id,group.name");
        $this->db->select("SUM(COALESCE(`productinput`.`value` * `productinput`.`quantity`, 0)) AS `value`", false);
        $this->db->from("group");
        $this->db->join("product", "product.group = group.id","left");
        $this->db->join("productinput", "productinput.product = product.id AND productinput.date > '$dateend'","left");
        $this->db->group_by("group.id");
        $this->db->order_by("group.id");
        $this->db->limit($limit,$start);
        $input_after = $this->db->get();

        $this->db->select("group.id,group.name");
        $this->db->select("SUM(COALESCE(`productoutput`.`value` * `productoutput`.`quantity`, 0)) AS `value`", false);
        $this->db->from("group");
        $this->db->join("product", "product.group = group.id","left");
        $this->db->join("productoutput", "productoutput.product = product.id AND productoutput.date BETWEEN '$datebeg' AND '$dateend'","left");
        $this->db->group_by("group.id");
        $this->db->order_by("group.id");
        $this->db->limit($limit,$start);
        $output = $this->db->get();

        $this->db->select("group.id,group.name");
        $this->db->select("SUM(COALESCE(`productoutput`.`value` * `productoutput`.`quantity`, 0)) AS `value`", false);
        $this->db->from("group");
        $this->db->join("product", "product.group = group.id","left");
        $this->db->join("productoutput", "productoutput.product = product.id AND productoutput.date > '$dateend'","LEFT");
        $this->db->group_by("group.id");
        $this->db->order_by("group.id");
        $this->db->limit($limit,$start);
        $output_after = $this->db->get();

        $this->db->select("group.id,group.name");
        $this->db->select("SUM(COALESCE(`productimmediate`.`value` * `productimmediate`.`quantity`, 0)) AS `value`", false);
        $this->db->from("group");
        $this->db->join("product", "product.group = group.id","left");
        $this->db->join("productimmediate", "productimmediate.product = product.id AND productimmediate.date BETWEEN '$datebeg' AND '$dateend'","left");
        $this->db->group_by("group.id");
        $this->db->order_by("group.id");
        $this->db->limit($limit,$start);
        $immediate = $this->db->get();

        $this->db->select("group.id,group.name");
        $this->db->select("SUM(COALESCE(`product`.`value` * `product`.`quantity`, 0)) AS `value`", false);
        $this->db->from("group");
        $this->db->join("product", "product.group = group.id","left");
        $this->db->group_by("group.id");
        $this->db->order_by("group.id");
        $this->db->limit($limit,$start);
        $now = $this->db->get();

        $resul = array();
        for($i = 0;$i < $input->num_rows();$i++){
            $input_row = $input->row($i);
            $output_row = $output->row($i);
            $immediate_row = $immediate->row($i);
            $input_after_row = $input_after->row($i);
            $output_after_row = $output_after->row($i);
            $now_row = $now->row($i);

            if($input_row->id == $output_row->id && $input_row->id == $immediate_row->id && $input_row->id == $input_after_row->id && $input_row->id == $output_after_row->id){
                $row = new stdClass();
                $row->id = $input_row->id;
                $row->name = $input_row->name;
                $row->before = $now_row->value - (($input_row->value - $output_row->value) + ($input_after_row->value - $output_after_row->value));
                $row->before = $row->before < 0?$row->before*(-1):$row->before;
                $row->input = $input_row->value+$immediate_row->value;
                $row->infisic = $input_row->value;
                $row->inimmediate = $immediate_row->value;
                $row->output = $output_row->value+$immediate_row->value;
                $row->outfisic = $output_row->value;
                $row->outimmediate = $immediate_row->value;
                $row->now = $row->before + $input_row->value - $output_row->value;
                $resul[] = $row;
            }
        }
        return $resul;
    }

    public function get_inout_total(){
        return $this->db->count_all('group');
    }
}
