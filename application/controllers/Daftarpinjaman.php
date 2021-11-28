<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daftarpinjaman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Daftarpinjaman_model', 'Anggota_model', 'Buku_model'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'daftarpinjaman/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'daftarpinjaman/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'daftarpinjaman/index.html';
            $config['first_url'] = base_url() . 'daftarpinjaman/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Daftarpinjaman_model->total_rows($q);
        $daftarpinjaman = $this->Daftarpinjaman_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'daftarpinjaman_data' => $daftarpinjaman,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Daftarpinjaman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('daftarpinjaman/daftarpinjaman_list', $data);
        $this->load->view('template/footer');
        // $this->load->view('daftarpinjaman/daftarpinjaman_list', $data);
    }

    public function read($id)
    {
        $row = $this->Daftarpinjaman_model->get_by_id($id);
        if ($row) {
            $data = array(
                'kodePeminjaman' => $row->kodePeminjaman,
                'tanggalPinjam' => $row->tanggalPinjam,
                'tanggalKembali' => $row->tanggalKembali,
                'tanggalDikembalikan' => $row->tanggalDikembalikan,
                'denda' => $row->denda,
                'idBuku' => $row->idBuku,
                'idAnggota' => $row->idAnggota,
            );
            $data['title'] = 'Daftarpinjaman';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('daftarpinjaman/daftarpinjaman_read', $data);
            $this->load->view('template/footer');
            // $this->load->view('daftarpinjaman/daftarpinjaman_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftarpinjaman'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('daftarpinjaman/create_action'),
            'kodePeminjaman' => set_value('kodePeminjaman'),
            'tanggalPinjam' => set_value('tanggalPinjam'),
            'tanggalKembali' => set_value('tanggalKembali'),
            'tanggalDikembalikan' => set_value('tanggalDikembalikan'),
            'denda' => set_value('denda'),
            'idBuku' => set_value('idBuku'),
            'idAnggota' => set_value('idAnggota'),
        );
        $data['title'] = 'Daftarpinjaman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('daftarpinjaman/daftarpinjaman_form', $data);
        $this->load->view('template/footer');
        // $this->load->view('daftarpinjaman/daftarpinjaman_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $tglPinjam = $this->input->post('tanggalPinjam', TRUE);
            $tglKembali = strtotime("+7 day", strtotime($tglPinjam));
            $tglKembali = date('Y-m-d', $tglKembali);
            $data = array(
                'tanggalPinjam' => $tglPinjam,
                'tanggalKembali' => $tglKembali,
                'idBuku' => $this->input->post('idBuku', TRUE),
                'idAnggota' => $this->input->post('idAnggota', TRUE),
            );

            $this->Daftarpinjaman_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('daftarpinjaman'));
        }
    }

    public function update($id)
    {
        $row = $this->Daftarpinjaman_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('daftarpinjaman/update_action'),
                'kodePeminjaman' => set_value('kodePeminjaman', $row->kodePeminjaman),
                'tanggalPinjam' => set_value('tanggalPinjam', $row->tanggalPinjam),
                'tanggalKembali' => set_value('tanggalKembali', $row->tanggalKembali),
                'tanggalDikembalikan' => set_value('tanggalDikembalikan', $row->tanggalDikembalikan),
                'denda' => set_value('denda', $row->denda),
                'idBuku' => set_value('idBuku', $row->idBuku),
                'idAnggota' => set_value('idAnggota', $row->idAnggota),
            );
            $data['list_buku'] = $this->Buku_model->get_all();
            $data['list_anggota'] = $this->Anggota_model->get_all();
            $data['title'] = 'Daftarpinjaman';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('daftarpinjaman/daftarpinjaman_form2', $data);
            $this->load->view('template/footer');
            // $this->load->view('daftarpinjaman/daftarpinjaman_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftarpinjaman'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kodePeminjaman', TRUE));
        } else {
            $tglKembali = $this->input->post('tanggalKembali', TRUE);
            $tglDikembalikan = $this->input->post('tanggalDikembalikan', TRUE);
            $t = date_create($tglKembali);
            $n = date_create($tglDikembalikan);
            if ($tglDikembalikan <= $tglKembali) {
                $denda = 0;
            } else {
                $terlambat = date_diff($t, $n);
                $hari = $terlambat->format("%a");
                $denda = $hari * 1000;
            }
            $data = array(
                'tanggalPinjam' => $this->input->post('tanggalPinjam', TRUE),
                'tanggalKembali' => $tglKembali,
                'tanggalDikembalikan' => $tglDikembalikan,
                'denda' => $denda,
                'idBuku' => $this->input->post('idBuku', TRUE),
                'idAnggota' => $this->input->post('idAnggota', TRUE),
            );

            $this->Daftarpinjaman_model->update($this->input->post('kodePeminjaman', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('daftarpinjaman'));
        }
    }

    public function delete($id)
    {
        $row = $this->Daftarpinjaman_model->get_by_id($id);

        if ($row) {
            $this->Daftarpinjaman_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('daftarpinjaman'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftarpinjaman'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('tanggalPinjam', 'tanggalpinjam', 'trim|required');
        $this->form_validation->set_rules('tanggalKembali', 'tanggalkembali', 'trim');
        $this->form_validation->set_rules('tanggalDikembalikan', 'tanggaldikembalikan', 'trim');
        $this->form_validation->set_rules('denda', 'denda', 'trim');
        $this->form_validation->set_rules('idBuku', 'idbuku', 'trim|required');
        $this->form_validation->set_rules('idAnggota', 'idanggota', 'trim|required');

        $this->form_validation->set_rules('kodePeminjaman', 'kodePeminjaman', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
