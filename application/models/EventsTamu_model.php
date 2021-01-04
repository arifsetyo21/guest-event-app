<?php
defined('BASEPATH') or exit('No direct script access allowed');
class EventsTamu_model extends CI_Model
{
    private $_table = 'events_tamu';

    protected $events_tamu_id;
    protected $tamu_id;
    protected $events_id;
    protected $qr_code_img;
    protected $confirmation_status;
    protected $time_attended;

    public function __construct()
    {
        $this->load->database();
        $this->load->model('tamu_model');
        $this->load->library('ciqrcode');
        $this->load->helper('MY_general');
        $this->load->config('email');
        $this->load->library('email');
    }

    public function rules()
    {
        return [
            [
                'field' => 'events_id',
                'label' => 'events_id',
                'rules' => 'required',
            ],
            [
                'field' => 'tamu_id',
                'label' => 'tamu_id',
                'rules' => 'required',
            ],
            [
                'field' => 'qr_code_img',
                'label' => 'qr_code_img',
                'rules' => 'required',
            ],
            [
                'field' => 'confirmation_status',
                'label' => 'confirmation_status',
                'rules' => 'required',
            ],
        ];
    }

    public function add($event_id = null, $tamu_id = null)
    {
        $data = [
            'events_id' => (int) $event_id,
            'tamu_id' => (int) $tamu_id,
        ];

        $this->db->set($data);
        $this->db->replace($this->_table, $this);

        $this->db->where('events_id', $event_id);
        $this->db->where('tamu_id', $tamu_id);
        $this->db->select('*');
        $this->db->join('tamu', 'events_tamu.tamu_id = tamu.id_tamu');
        $this->db->join('events', 'events_tamu.events_id = events.event_id');
        $this->db->from('events_tamu');
        $result_query_events_tamu_table = $this->db->get();

        $events_tamu = $result_query_events_tamu_table->result_array()[0];

        $this->ciqrcode->initialize(qr_code_config()['config']);
        $this->ciqrcode->generate(qr_code_config($events_tamu['events_tamu_id'])['params']);

        $data['qr_code_img'] = $events_tamu['events_tamu_id'];
        $qr_code_img_name = $events_tamu['events_tamu_id'] . '.png';

        $this->db->set('qr_code_img', $qr_code_img_name);
        $this->db->where('events_tamu_id', $events_tamu['events_tamu_id']);
        $this->db->update('events_tamu');

        $events_tamu['qr_code_img'] = $qr_code_img_name;

        $from = $this->config->item('smtp_user');
        $to = $events_tamu['email'];
        $subject = '[UNDANGAN] Acara ' . $events_tamu['name'];
        $data = [
            'events_tamu' => $events_tamu,
        ];

        $body = $this->load->view('template/email.php', $data, true);

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($body);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function listTamuNotIncludeEvent($event_id = null, $tamuIdInvited = [])
    {
        if (count($tamuIdInvited) < 1) {
            return $this->tamu_model->listing();
        }

        $this->db->select('id_tamu, nama, whatsapp, email, alamat');
        // $this->db->select('*');
        $this->db->where_not_in('id_tamu', $tamuIdInvited);
        $this->db->from('tamu');

        $query = $this->db->get();
        return $query->result();

    }

    public function confirmAttended($eventsTamuId = null)
    {
        $data = [
            'confirmation_status' => 'datang',
            'time_attended' => date('Y-m-d H:i:s'),
        ];

        $this->db->where('events_tamu_id', $eventsTamuId);
        return $this->db->update('events_tamu', $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("events_tamu_id" => $id));
    }
}
