<?php
class Consumer_model extends MY_model {

    public function add($data){
        $this->db->insert("consumer",$data);
        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function update($id,$data){
        $this->db->where('idconsumer', $id);
        $this->db->update('consumer', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            $data['idconsumer'] = $id;
            $query = $this->db->get_where('consumer', $data);
            if ($query->num_rows() > 0){
                return true;
            }
        }
        return false;
    }

    public function get_list($start = 0, $limit = 20,$term=false){
        $this->db->order_by("name");
        if($term){
            $this->db->like("name",$term);
            if(is_numeric($term)){
                $this->db->or_like("CAST(`idconsumer` as CHAR(50))",$term,'after');
            }
        }
        $query = $this->db->get('consumer', $limit, $start);
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function get_total($term=false){
        if($term){
            $this->db->like("name",$term);
            if(is_numeric($term)){
                $this->db->or_like("CAST(`idconsumer` as CHAR(50))",$term,'after');
            }
            $query = $this->db->get('consumer');
            return $query->num_rows();
        }
        return $this->db->count_all('consumer');
    }

    public function get_by_id($id){
        $query = $this->db->get_where('consumer', array('idconsumer' => $id), 1);
        if ($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function get_all(){
        $this->db->order_by("name");
        $query = $this->db->get('consumer');
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
}
?>
