<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'anggota/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'anggota/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'anggota/index.html';
            $config['first_url'] = base_url() . 'anggota/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Anggota_model->total_rows($q);
        $anggota = $this->Anggota_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'anggota_data' => $anggota,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Anggota';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('anggota/anggota_list', $data);
        $this->load->view('template/footer');
    }

    public function read($id)
    {
        $row = $this->Anggota_model->get_by_id($id);
        if ($row) {
            $data = array(
                'idAnggota' => $row->idAnggota,
                'namaAnggota' => $row->namaAnggota,
                'alamatAnggota' => $row->alamatAnggota,
                'statusKeanggotaan' => $row->statusKeanggotaan,
            );
            $data['title'] = 'Anggota';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('anggota/anggota_read', $data);
            $this->load->view('template/footer');
            //$this->load->view('anggota/anggota_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('anggota'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('anggota/create_action'),
            'idAnggota' => set_value('idAnggota'),
            'namaAnggota' => set_value('namaAnggota'),
            'alamatAnggota' => set_value('alamatAnggota'),
            'statusKeanggotaan' => set_value('statusKeanggotaan'),
        );
        $data['title'] = 'Anggota';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('anggota/anggota_form', $data);
        $this->load->view('template/footer');
        //$this->load->view('anggota/anggota_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'namaAnggota' => $this->input->post('namaAnggota', TRUE),
                'alamatAnggota' => $this->input->post('alamatAnggota', TRUE),
                'statusKeanggotaan' => $this->input->post('statusKeanggotaan', TRUE),
            );

            $this->Anggota_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('anggota'));
        }
    }

    public function update($id)
    {
        $row = $this->Anggota_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('anggota/update_action'),
                'idAnggota' => set_value('idAnggota', $row->idAnggota),
                'namaAnggota' => set_value('namaAnggota', $row->namaAnggota),
                'alamatAnggota' => set_value('alamatAnggota', $row->alamatAnggota),
                'statusKeanggotaan' => set_value('statusKeanggotaan', $row->statusKeanggotaan),
            );
            $data['title'] = 'Anggota';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('anggota/anggota_form', $data);
            $this->load->view('template/footer');
            //$this->load->view('anggota/anggota_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('anggota'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idAnggota', TRUE));
        } else {
            $data = array(
                'namaAnggota' => $this->input->post('namaAnggota', TRUE),
                'alamatAnggota' => $this->input->post('alamatAnggota', TRUE),
                'statusKeanggotaan' => $this->input->post('statusKeanggotaan', TRUE),
            );

            $this->Anggota_model->update($this->input->post('idAnggota', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('anggota'));
        }
    }

    public function delete($id)
    {
        $row = $this->Anggota_model->get_by_id($id);

        if ($row) {
            $this->Anggota_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('anggota'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('anggota'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('namaAnggota', 'namaanggota', 'trim|required');
        $this->form_validation->set_rules('alamatAnggota', 'alamatanggota', 'trim|required');
        $this->form_validation->set_rules('statusKeanggotaan', 'statuskeanggotaan', 'trim|required');

        $this->form_validation->set_rules('idAnggota', 'idAnggota', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
