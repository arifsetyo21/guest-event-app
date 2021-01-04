<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tamu_model extends CI_Model
{
    public function __construct()
    {
        //parent::__construct();
        $this->load->database();
    }
    //listing all tamu
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('tamu');
        $this->db->order_by('id_tamu', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    //detail tamu
    public function detail($id_tamu)
    {
        $this->db->select('*');
        $this->db->from('tamu');
        $this->db->where('id_tamu', $id_tamu);
        $this->db->order_by('id_tamu', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    //tambah
    public function tambah($a, $b, $c, $d, $image_name = null, $e = null)
    {
        $tamu = array(
            // 'id_tamu' => $nik, //id otomatis gak di ambil dari get
            'nama' => $a,
            'whatsapp' => $b,
            'email' => $c,
            'alamat' => $d,
            'image_name' => $image_name,
            'konfirmasi' => $e,

        );
        $this->db->insert('tamu', $tamu);
        return $this->db->insert_id();
    }
    //edit
    public function edit($data)
    {
        $this->db->where('id_tamu', $data['id_tamu']);
        $this->db->update('tamu', $data);
    }
//hapus
    public function delete($data)
    {
        $this->db->where('id_tamu', $data['id_tamu']);
        $this->db->delete('tamu', $data);
    }
}
