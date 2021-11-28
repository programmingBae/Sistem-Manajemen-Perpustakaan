<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('template/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //mengecek jika ada gambar yang akan diupload
            $uploadImage = $_FILES['image']['name'];

            if ($uploadImage) {
                //PERTAMA MELAKUKAN PENGECEKAN
                //type file yang diupload boleh apa saja..
                $config['allowed_types'] = 'gif|jpg|png';
                //max besar ukuran file yang akan diupload.. disini 2 mb
                $config['max_size']     = '2048';
                //tempat menyimpan gambar yang diupload
                $config['upload_path'] = './assets/img/profile';
                //library nya
                $this->load->library('upload', $config);
                //KALAU BERHASIL
                if ($this->upload->do_upload('image')) {
                    //mengetahui nama file gambar sebelumnya.. atau curent  yang sekarang sebelum diganti
                    $oldImage = $data['user']['image'];
                    if ($oldImage != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $oldImage);
                    }

                    $newImage = $this->upload->data('file_name');
                    $this->db->set('image', $newImage);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                    Profile Updated!
                </div>'
            );
            redirect('user');
        }
    }

    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newPass1', 'New Password', 'required|trim|min_length[3]|matches[newPass2]');
        $this->form_validation->set_rules('newPass2', 'Confrim New Password', 'required|trim|min_length[3]|matches[newPass1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('template/footer');
        } else {
            $currentPassword = $this->input->post('currentPassword');
            $newPass = $this->input->post('newPass1');
            if (!password_verify($currentPassword, $data['user']['password'])) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                        Wrong Current Password!
                    </div>'
                );
                redirect('user/changepassword');
            } else {
                if ($currentPassword == $newPass) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                            New Password must not be same!
                        </div>'
                    );
                    redirect('user/changepassword');
                } else {
                    //pass sudah benar

                    $password_hash = password_hash($newPass, PASSWORD_DEFAULT);
                    //men set colom password menjadi new password yang sudah di encrypted
                    $this->db->set('password', $password_hash);
                    //update password dimnana di tabel user yang colom nya email sama dengan data email dari yang akan diganti password nya
                    $this->db->where('email', $data['user']['email']);
                    //this.update table user
                    $this->db->update('user');

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                           Password Changed!
                        </div>'
                    );
                    redirect('user/changepassword');
                }
            }
        }
    }
}
