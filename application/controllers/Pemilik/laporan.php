<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function index()
    {

        $data = array(
            'title' => 'Laporan',
            'isi' => 'pemilik/laporan'
        );

        $this->load->view('pemilik/layout', $data, FALSE);
        
    }

}

/* End of file Dashboard.php */

?>