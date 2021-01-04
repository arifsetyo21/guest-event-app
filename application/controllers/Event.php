<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->model('tamu_model');
        $this->load->model('eventsTamu_model');
        $this->load->library('Mcarbon');
        $this->load->library('form_validation');
    }

    //data tamu
    public function index()
    {
        if (isset($_SESSION['id']) == true) {

            // $dt = Mcarbon::createFromDate(2018, 2, 13, null);

            $events = $this->listAllEvent();

            $data = array(
                'title' => 'Data Event',
                'events' => $events,
                'isi' => 'index.php/event',
            );

            $this->load->view('template/atas', $data, false);
            $this->load->view('event/list', $data, false);
            $this->load->view('template/bawah');
        } else {
            redirect(base_url('index.php/Auth'), 'refresh');
        }
    }

    public function detail($id = null)
    {
        if (isset($_SESSION['id']) == true) {
            $event = $this->event_model->getById($id);
            $tamus = $this->event_model->getAllTamu($id);

            $tamuNotInvited = [];
            foreach ($tamus as $tamu) {
                $tamuNotInvited[] = $tamu->tamu_id;
            }

            $tamuNotInvitedList = $this->eventsTamu_model->listTamuNotIncludeEvent($id, $tamuNotInvited);

            $startAtFormattedCarbon = Mcarbon::parse($event->start_at);
            $endAtFormattedCarbon = Mcarbon::parse($event->end_at);

            // $event->start_at_carbon = $startAtFormattedCarbon->isoFormat('dddd, D MMMM Y H:i');
            $event->start_at_carbon = $startAtFormattedCarbon->isoFormat('LLLL');
            // $event->end_at_carbon = $endAtFormattedCarbon->isoFormat('dddd, D MMMM Y');
            $event->end_at_carbon = $endAtFormattedCarbon->isoFormat('LLLL');

            $data = array('title' => 'Detail Event',
                'event' => $event,
                'tamu' => $tamus,
                'tamuNotInvitedList' => $tamuNotInvitedList,
                'isi' => 'index.php/event',
            );

            $this->load->view('template/atas', $data, false);
            $this->load->view('event/detail', $data, false);
            $this->load->view('template/bawah');
        } else {
            redirect(base_url('index.php/Auth'), 'refresh');
        }

    }

    public function add()
    {
        if ((isset($_SESSION['id']) == true)) {
            $event = $this->event_model;
            $validation = $this->form_validation;
            $validation->set_rules($event->rules());

            if ($validation->run()) {
                $event->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }

            $data = array(
                'title' => 'Detail Event',
                'event' => $event,
                'isi' => 'index.php/event',
            );

            $this->load->view('template/atas', $data);
            $this->load->view('event/tambah', $event, false);
            return $this->load->view('template/bawah');
        }

        redirect(base_url('index.php/Auth'), 'refresh');
    }

    public function edit($id = null)
    {
        if ((isset($_SESSION['id']) == true)) {

            if (is_null($id)) {
                redirect(base_url('index.php/event'), 'refresh');
            }

            $event = $this->event_model;
            $validation = $this->form_validation;
            $validation->set_rules($event->rules());

            if ($validation->run()) {
                $event->update();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }

            $data['event'] = $event->getById($id);
            if (!$data["event"]) {
                show_404();
            }

            $this->load->view('template/atas');
            $this->load->view('event/edit', $data, false);
            return $this->load->view('template/bawah');
        }

        redirect(base_url('index.php/Auth'), 'refresh');
    }

    public function delete($id = null)
    {
        if ((isset($_SESSION['id']) == true)) {

            if (is_null($id)) {
                redirect(base_url('index.php/event'), 'refresh');
            }

            $this->event_model->delete($id);
            $this->session->set_flashdata('success', 'Data telah dihapus');
            return redirect(base_url('index.php/event'), 'refresh');
        }

        $this->session->set_flashdata('fail', 'Data gagal dihapus');
        return redirect(base_url('index.php/event'), 'refresh');
    }

    public function addEventTamu($id = null)
    {
        if ((isset($_SESSION['id']) == true)) {
            if (is_null($id)) {
                redirect(base_url('index.php/event'), 'refresh');
            }

            $eventsTamu = $this->eventsTamu_model;

            $validation = $this->form_validation;
            $validation->set_rules($eventsTamu->rules());

            $this->eventsTamu_model->add($id, $this->input->post('tamu_id'));
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            $data = [
                'events' => $this->listAllEvent(),
            ];

            return redirect(base_url('index.php/event/detail/' . $id), 'refresh');

            // $this->load->view('template/atas');
            // $this->load->view('event/list', $data, false);
            // return $this->load->view('template/bawah');
        }
    }

    public function addEventNewTamu($id = null)
    {
        if ((isset($_SESSION['id']) == true)) {
            if (is_null($id)) {
                redirect(base_url('index.php/event'), 'refresh');
            }

            $eventsTamu = $this->eventsTamu_model;

            $validation = $this->form_validation;
            $validation->set_rules($eventsTamu->rules());

            $this->eventsTamu_model->add($id, $this->input->post('tamu_id'));
            $this->session->set_flashdata('success', 'Berhasil disimpan');

            $data = [
                'events' => $this->listAllEvent(),
            ];

            $this->load->view('template/atas');
            $this->load->view('event/list', $data, false);
            return $this->load->view('template/bawah');
        }
    }

    public function listAllEvent()
    {
        $events = $this->event_model->getAll();

        foreach ($events as $key => $event) {
            $startAtFormattedCarbon = Mcarbon::parse($event->start_at);
            $endAtFormattedCarbon = Mcarbon::parse($event->end_at);

            $events[$key]->start_at_carbon = $startAtFormattedCarbon->isoFormat('dddd, D MMMM Y');
            $events[$key]->end_at_carbon = $endAtFormattedCarbon->isoFormat('dddd, D MMMM Y');
        }

        return $events;
    }

    public function confirmAttended($eventsTamuId)
    {
        $this->eventsTamu_model->confirmAttended($eventsTamuId);

        $this->session->set_flashdata('success', 'Kedatangan Berhasil Di Konfirmasi');
        return $this->load->view('event/confirmed');
    }

    public function deleteEventsTamu($eventId, $eventsTamuId)
    {
        $this->eventsTamu_model->delete($eventsTamuId);

        return redirect(base_url('index.php/event/detail/' . $eventId), 'refresh');
    }

}
