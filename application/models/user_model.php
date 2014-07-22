<?php
class User_model extends MY_model {

    public function add($data){
        $this->db->insert("user",$data);
        if($this->db->affected_rows() > 0){
            return true;
        }
        return false;
    }

    public function update($id,$data){
        $this->db->where('iduser', $id);
        $this->db->update('user', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            $data['iduser'] = $id;
            $query = $this->db->get_where('user', $data);
            if ($query->num_rows() > 0){
                return true;
            }
        }
        return false;
    }

    public function get_list($start = 0, $limit = 20){
        $this->db->order_by("name");
        $query = $this->db->get('user', $limit, $start);
        if ($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function get_total(){
        return $this->db->count_all('user');
    }

    public function get_by_id($id){
        $query = $this->db->get_where('user', array('iduser' => $id), 1);
        if ($query->num_rows() > 0){
            return $query->row();
        }
    }
}
?>
