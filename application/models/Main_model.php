<?php
class Main_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function get($table,$select,$where=false,$oneRow=false){

        $this->db->select($select);
        $this->db->from($table);
        if($where == TRUE){
            $this->db->where($where);
        }
        $query = $this->db->get();
        $query->row();

        if ($oneRow == TRUE) {
            return $query->first_row();
        }else{
            if ($resultArray == TRUE) {
                return $query->result_array();
            }else{
                return $query->result();
            }
        }

    }

    public function insert($table,$data){
        $this->db->set($data);
        $this->db->insert($table);
    }

    public function delete($table,$where){
        $this->db->delete($table,$where);
    }

    public function update($table,$where,$data){
        $this->db->where($where);
        $this->db->update($table, $data);    }
}
?>