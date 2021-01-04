<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Event_model extends CI_Model
{
    private $_table = 'events';

    public $event_id;
    public $name;
    public $start_at;
    public $end_at;
    public $location;
    public $notes;

    public function __construct()
    {
        $this->load->database();
    }

    public function rules()
    {
        return [
            [
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required',
            ],
            [
                'field' => 'start_at',
                'label' => 'start at',
                'rules' => 'required',
            ],
            [
                'field' => 'end_at',
                'label' => 'end at',
                'rules' => 'required',
            ],
            [
                'field' => 'location',
                'label' => 'location',
                'rules' => 'required',
            ],
        ];
    }
    //listing all tamu
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('events');
        $this->db->order_by('event_id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllTamu($id = null)
    {
        $this->db->select('events_tamu_id, tamu_id, nama, whatsapp, email, alamat, qr_code_img, confirmation_status, time_attended');
        // $this->db->select('*');
        $this->db->where('events.event_id', $id);
        $this->db->from('events');
        $this->db->join('events_tamu', 'events.event_id = events_tamu.events_id');
        $this->db->join('tamu', 'events_tamu.tamu_id = tamu.id_tamu');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $query = $this->db->get_where($this->_table, ['event_id' => $id])->row();
        return $query;
    }

    public function save()
    {
        $post = $this->input->post();
        $this->name = $post['name'];
        $this->start_at = $post['start_at'];
        $this->end_at = $post['end_at'];
        $this->location = $post['location'];
        $this->notes = $post['notes'];
        return $this->db->insert($this->_table, $this);
    }

    public function update($id = null)
    {
        $post = $this->input->post();
        $this->event_id = $post['id'];
        $this->name = $post['name'];
        $this->start_at = $post['start_at'];
        $this->end_at = $post['end_at'];
        $this->location = $post['location'];
        $this->notes = $post['notes'];

        return $this->db->update($this->_table, $this, array('event_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("event_id" => $id));
    }

}
