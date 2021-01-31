<?php
class models_tugas extends CI_Model {

    public function get_data (){
    
        return $this->db->query("SELECT * FROM tbl_pegawai")->result();    
    }
    public function tambah($input){
        return $this->db->insert('tbl_pegawai', $input);
    }
    public function edit($input, $id){       
        return $this->db->where('nip',$id)->update('tbl_pegawai', $input);
             
    }
    public function hapus($id){
        return $this->db->where('nip',$id)->delete('tbl_pegawai');
    }
}
?>