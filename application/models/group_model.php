<?php
class Group_model extends MY_model {

    public function add($data){
        $this->db->insert("group",$data);
        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function update($id,$data){
        $this->db->where('idgroup', $id);
        $this->db->update('group', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            $data['idgroup'] = $id;
            $query = $this->db->get_where('group', $data);
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
                $this->db->or_like("CAST(`idgroup` as CHAR(50))",$term,'after');
            }
        }
        $query = $this->db->get('group', $limit, $start);
        if ($query->num_rows() > 0){
            return $query->result();
        }
    }

    public function get_all(){
        $this->db->order_by("name");
        $query = $this->db->get('group');
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function get_total($term){
        if($term){
            $this->db->like("name",$term);
            if(is_numeric($term)){
                $this->db->or_like("CAST(`idgroup` as CHAR(50))",$term,'after');
            }
            $query = $this->db->get('group');
            return $query->num_rows();
        }
        return $this->db->count_all('group');
    }

    public function get_by_id($id){
        $query = $this->db->get_where('group', array('idgroup' => $id), 1);
        if ($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }
}
?>
