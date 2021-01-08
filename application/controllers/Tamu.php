<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tamu extends CI_Controller
{

    //load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tamu_model');
        $this->load->model('eventsTamu_model');
        $this->load->library('user_agent');

        //proteksi halaman
        // $this->simple_login->cek_login();
    }
    //data tamu
    public function index()
    {
        if (isset($_SESSION['id']) == true) {
            $tamu = $this->tamu_model->listing();

            $data = array('title' => 'Data Tamu',
                'tamu' => $tamu,
                'isi' => 'index.php/tamu/list',
            );
            $this->load->view('template/atas');
            $this->load->view('tamu/list', $data, false);
            $this->load->view('template/bawah');
        } else {
            redirect(base_url('index.php/Auth'), 'refresh');
        }
    }
    //tambah tamu
    public function tambah()
    {
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama', 'Nama Tamu', 'required',
            array('required' => '%s harus diisi dulu ya'));

        $valid->set_rules('whatsapp', 'Whatsapp', 'required',
            array('required' => '%s harus diisi dulu ya'));

        $valid->set_rules('email', 'Email', 'required|valid_email',
            array('required' => '%s harus diisi dulu ya',
                'valid_email' => '%s tidak valid'));

        $valid->set_rules('alamat', 'Alamat', 'required',
            array('required' => '%s harus diisi dulu ya'));

        $valid->set_rules('konfirmasi', 'konfirmasi', 'required',
            array('required' => '%s harus diisi dulu ya'));

        if ($valid->run() == false) {
            //valid end
            $data = array('title' => 'Tambah Tamu',
                'isi' => 'index.php/tamu/tambah',
            );
            $this->load->view('template/atas');
            $this->load->view('tamu/tambah', $data, false);
            $this->load->view('template/bawah');

        } else {

            // coding tambah yang baru

            $nama = $this->input->post('nama');
            $whatsapp = $this->input->post('whatsapp');
            $email = $this->input->post('email');
            $alamat = $this->input->post('alamat');
            $konfirmasi = $this->input->post('konfirmasi');

            $this->load->library('ciqrcode'); //pemanggilan library QR CODE

            $config['cacheable'] = true; //boolean, the default is true
            $config['cachedir'] = './assets/'; //string, the default is application/cache/
            $config['errorlog'] = './assets/'; //string, the default is application/logs/
            $config['imagedir'] = './assets/images/'; //direktori penyimpanan qr code
            $config['quality'] = true; //boolean, the default is true
            $config['size'] = '1024'; //interger, the default is 1024
            $config['black'] = array(224, 255, 255); // array, default is array(255,255,255)
            $config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);

            $image_name = $nama . '.png'; //buat name dari qr code sesuai dengan nama

            $id_tamu = $this->tamu_model->tambah($nama, $whatsapp, $email, $alamat, $image_name, $konfirmasi); //simpan ke database

            $params['data'] = base_url('index.php/Tamu/update_status/' . $id_tamu); //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

            // redirect('tamu'); //redirect ke mahasiswa usai simpan data
            $this->session->set_flashdata('sukses', 'Data telah ditambahkan');
            redirect(base_url('index.php/tamu'), 'refresh');

        }
    }
//

//edit tamu

// update status
    public function update_status($id_tamu)
    {
        $data = $this->db->query("SELECT * FROM tamu WHERE id_tamu = '$id_tamu'")->result_array();
        foreach ($data as $sData) {
            $nama = $sData['nama'];
        }

        echo "Selamat datang " . $nama;

        $data = $this->db->query("UPDATE tamu SET konfirmasi = 'datang' WHERE id_tamu = '$id_tamu'");

//     $data = array(
        //         'status' => 'datang'
        //     );

//     $this->db->where('id_tamu', $id_tamu);
        //     $this->db->update('tamu', $data);

//     redirect(base_url('admin/update_status'),'refresh');
    }
// update status

    public function edit($id_tamu)
    {
        $tamu = $this->tamu_model->detail($id_tamu);

        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama', 'Nama Tamu', 'required',
            array('required' => '%s harus diisi dulu ya'));

        $valid->set_rules('whatsapp', 'Whatsapp', 'required',
            array('required' => '%s harus diisi dulu ya'));

        $valid->set_rules('email', 'Email', 'required|valid_email',
            array('required' => '%s harus diisi dulu ya',
                'valid_email' => '%s tidak valid'));

        $valid->set_rules('alamat', 'Alamat', 'required',
            array('required' => '%s harus diisi dulu ya'));

        $valid->set_rules('konfirmasi', 'konfirmasi', 'required',
            array('required' => '%s harus diisi dulu ya'));

        if ($valid->run() == false) {
            //valid end
            $data = array('title' => 'Edit Data Tamu',
                'tamu' => $tamu,
                'isi' => 'tamu/edit',
            );
            $this->load->view('template/atas');
            $this->load->view('tamu/edit', $data, false);
            $this->load->view('template/bawah');

        } else {
            //masuk ke database
            $i = $this->input;
            $tamu = array('id_tamu' => $id_tamu,
                'nama' => $i->post('nama'),
                'whatsapp' => $i->post('whatsapp'),
                'email' => $i->post('email'),
                'alamat' => $i->post('alamat'),
                'konfirmasi' => $i->post('konfirmasi'),
            );
            $this->tamu_model->edit($tamu);
            $this->session->set_flashdata('sukses', 'Data telah diedit');
            redirect(base_url('index.php/Tamu'), 'refresh');

        }

        //end masuk database
    }

//delete tamu
    public function delete($id_tamu)
    {
        $data = array('id_tamu' => $id_tamu);
        $this->tamu_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('index.php/tamu'), 'refresh');

    }
//validasi email dan whatsapp

    public function addTamuAndAttachToEvent($event_id = null)
    {
        $nama = $this->input->post('nama');
        $whatsapp = $this->input->post('whatsapp');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');

        $tamu_id = $this->tamu_model->tambah($nama, $whatsapp, $email, $alamat); //simpan ke database

        $this->eventsTamu_model->add($event_id, $tamu_id);

        if ($this->agent->is_referral()) {
            return $this->agent->referrer();
        }

        return redirect(base_url('index.php/event/detail/' . $event_id), 'refresh');
    }

    public function searchTamu(string $keyword = null)
    {
        // $tamu = $this->tamu_model->listing();

        header("Content-Type: application/json");
        $this->db->select('*');
        $this->db->from('tamu');
        if (!is_null($keyword)) {
            $this->db->like('nama', $keyword, 'both');
        }
        $this->db->order_by('id_tamu', 'asc');
        $query = $this->db->get()->result_array();

        echo json_encode($query);
    }
}
