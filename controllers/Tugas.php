<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class Tugas extends CI_Controller{
  
    function __construct(){
        parent::__construct();
        $this->load->model('models_tugas');
    }

    public function index(){
        if($this->session->userdata('nip')!= NULL){

            $a['data'] = $this->models_tugas->get_data();

            // var_dump($a['data']); exit;
            
            $this->load->view('include/head');
            $this->load->view('include/top-header');
            $this->load->view('view_tugas', $a);
            $this->load->view('include/sidebar');
            $this->load->view('include/panel');
            $this->load->view('include/footer');
        }else{
            redirect('user');
        }
    }
    public function tambah_tugas(){
        $input['nip'] = $this->input->post('nip');
        $input['nama'] = $this->input->post('nama');
        $input['cp'] = $this->input->post('cp');
        $input['jur'] = $this->input->post('jur');
        $input['pangkat'] = $this->input->post('pangkat');
        $input['gol'] = $this->input->post('gol');
        $input['eselon'] = $this->input->post('eselon');
        $input['jabatan'] = $this->input->post('jabatan');

        // var_dump($this->input->post('nama'));exit;
        $result = $this->models_tugas->tambah($input);

        if (!$results){
            $this->session->set_flashdata('tugas','data berhasil diinputkan');
            redirect('tugas');
        }else{
            $this->session->set_flashdata('tugas','data gagal diinputkan');
            redirect('home');
        }
    }

    public function edit_tugas(){
        $id = $this->input->post('id');
        
        $input['nama'] = $this->input->post('nama');
        $input['cp'] = $this->input->post('cp');
        $input['jur'] = $this->input->post('jur');
        $input['pangkat'] = $this->input->post('pangkat');
        $input['gol'] = $this->input->post('gol');
        $input['eselon'] = $this->input->post('eselon');
        $input['jabatan'] = $this->input->post('jabatan');


        // var_dump($this->input->post('nama'));exit;
        $result = $this->models_tugas->edit($input, $id);

        if (!$results){
            redirect('tugas');
        }else{
            redirect('home');
        }
    }
    public function hapus_tugas(){
        $id = $this->input->post('id');

        $result = $this->models_tugas->hapus($id);
        
        if (!$results){
            redirect('tugas');
        }else{
            redirect('home');
        }
    }

    public function uploadPagu(){
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            if(isset($_FILES['pagu']['name']) && in_array($_FILES['pagu']['type'],$file_mimes)){
            
                $arr_file = explode('.', $_FILES['pagu']['name']);
                $extension = end($arr_file);

            }

        if($extension != 'xlsx') {
            $this->session->set_flashdata('notifpagu', '<div class="alert alert-danger"><b>PROSES IMPORT DATA GAGAL!</b> Format file yang anda masukkan salah!</div>');
            redirect("tugas"); 
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $loadexcel = $reader->load($_FILES['pagu']['tmp_name']); //mengambil nama asli file excel nya

        $sheet = $loadexcel->getActiveSheet()->toArray(null,true,true,true); //mengambil sheet yang aktif, gk tau kenapa true2 3x
        
        $numrow = 0;
        $unitsas = array();
        foreach ($sheet as $row) {
            $numrow++;
            if($numrow > 1){
                    array_push($unitsas,array(
                        'cp' => $row['B'],
                        'jur' => $row['C'],
                        'nama' => $row['D'],
                        'nip' => $row['E'],
                        'pangkat' => $row['F'],
                        'gol' => $row['G'],
                        'eselon' => $row['H'],
                        'jabatan' => $row['I']
                    ));
                }
            }
        $this->db->insert_batch('tbl_pegawai',$unitsas);
        // $this->db->insert_batch('unit_sas',$unitsas);
        // $this->db->insert_batch('output_sas',$outputsas);
        
        $this->session->set_flashdata('notifpagu', '<div class="alert alert-success"><b>DATA BERHASIL DISIMPAN!</b> </div>');
            redirect("tugas"); 
        
    }

}