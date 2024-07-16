<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load required libraries and helpers
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        // Check if user is logged in
        if (!$this->session->userdata('users')) {
            // Jika user belum login, arahkan ke halaman login atau sesuai kebijakan Anda
            redirect(base_url('admin'));
        }

        // Form validation and other logic
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('subject', 'subject', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            // Load data from database
            $settings = $this->db->get('tb_settings')->row_array();
            $dokumentasi = $this->db->get('tb_dokumentasi', 6)->result();
            $quote = $this->db->get('tb_quote')->result();

            $data = array(
                'title' => 'D Furnitur',
                'isi' => 'user/home',
                'settings' => $settings,
                'dokumentasi' => $dokumentasi,
                'quote' => $quote,
                'user' => $this->session->userdata('users') // Ambil data pengguna dari session
            );


            $this->load->view('user/layout', $data, FALSE);
        } else {
            $this->load->library('email');

            $mail_config['smtp_host'] = 'smtp.gmail.com';
            $mail_config['smtp_port'] = '587';
            $mail_config['smtp_user'] = 'rais.akbar3110@gmail.com';
            $mail_config['_smtp_auth'] = TRUE;
            $mail_config['smtp_pass'] = 'picipricswlkuism';
            $mail_config['smtp_crypto'] = 'tls';
            $mail_config['protocol'] = 'smtp';
            $mail_config['mailtype'] = 'html';
            $mail_config['send_multipart'] = FALSE;
            $mail_config['charset'] = 'utf-8';
            $mail_config['wordwrap'] = TRUE;
            $this->email->initialize($mail_config);

            $this->email->set_newline("\r\n");

            // Set to, from, message, etc.

            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $subject = htmlspecialchars($_POST['subject']);
            $message = htmlspecialchars($_POST['message']);

            $this->load->library('email');

            $this->email->from($email, $name);
            $this->email->to('rais.akbar3110@gmail.com');

            $this->email->subject($subject);
            $this->email->message($message);

            $send = $this->email->send();

            if ($send) {
                echo '<script>alert("Sukses")</script>';
            } else {
                $error = $this->email->print_debugger(array('headers'));
                echo "<script>" . json_encode($error) . "</script>";
            }
        }
    }

    public function dokumentasi($id)
    {

          // Check if user is logged in
          if (!$this->session->userdata('users')) {
            // Jika user belum login, arahkan ke halaman login atau sesuai kebijakan Anda
            redirect(base_url('admin'));
        }
            // Form validation and other logic
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('subject', 'subject', 'trim|required');

        $settings = $this->db->get('tb_settings')->row_array();
        $dokumentasi = $this->db->get_where('tb_dokumentasi', ['id_dokumentasi' => $id])->row_array();

        $data = array(
            'title' => 'D Furnitur',
            'isi' => 'user/dokumentasi/detail',
            'settings' => $settings,
            'dokumentasi' => $dokumentasi,
            'user' => $this->session->userdata('users') // Ambil data pengguna dari session
        );
        $this->load->view('user/layout', $data, FALSE);
    }

    public function allitem()
    {
            // Check if user is logged in
            if (!$this->session->userdata('users')) {
                // Jika user belum login, arahkan ke halaman login atau sesuai kebijakan Anda
                redirect(base_url('admin'));
            }
    
            // Form validation and other logic
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('subject', 'subject', 'trim|required');

        $settings = $this->db->get('tb_settings')->row_array();
        $dokumentasi = $this->db->get('tb_dokumentasi')->result();

        $data = array(
            'title' => 'D Furnitur',
            'isi' => 'user/dokumentasi/all',
            'settings' => $settings,
            'dokumentasi' => $dokumentasi,
            'user' => $this->session->userdata('users') // Ambil data pengguna dari session
        );
        $this->load->view('user/layout', $data, FALSE);
    }
   // Fungsi logout
    public function logout()
    {
        // Hapus data user dari session
        $this->session->unset_userdata('users');
        // Arahkan ke halaman utama
        redirect(base_url('admin'));
    }

}

/* End of file Landinguser.php */


// login controler


