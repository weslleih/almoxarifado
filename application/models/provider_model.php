<?php
class Provider_model extends MY_model {

    public function add($data){
        $this->db->insert("provider",$data);
        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function update($id,$data){
        $this->db->where('idprovider', $id);
        $this->db->update('provider', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            $data['idprovider'] = $id;
            $query = $this->db->get_where('provider', $data);
            if ($query->num_rows() > 0){
                return true;
            }
        }
        return false;
    }

    public function get_list($start = 0, $limit = 20,$term){
        $this->db->order_by("name");

        if($term){
            $this->db->like("name",$term);
            if(is_numeric($term)){
                $this->db->or_like("CAST(`idprovider` as CHAR(50))",$term,'after');
                $this->db->or_like("document",$term,'after');
            }else{
                $this->db->or_like("document",$term);
            }
        }

        $query = $this->db->get('provider', $limit, $start);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function get_all(){
        $this->db->order_by("name");

        $query = $this->db->get('provider');
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function get_total($term){
        if($term){
            $this->db->like("name",$term);
            if(is_numeric($term)){
                $this->db->or_like("CAST(`idprovider` as CHAR(50))",$term,'after');
                $this->db->or_like("document",$term,'after');
            }else{
                $this->db->or_like("document",$term);
            }
            $query = $this->db->get('provider');
            return $query->num_rows();
        }
        return $this->db->count_all('provider');
    }

    public function get_by_id($id){
        $query = $this->db->get_where('provider', array('idprovider' => $id), 1);
        if ($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }
}
?>
