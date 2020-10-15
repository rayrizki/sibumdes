<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed!');

class User extends CI_Controller
{
    public function index()
    {

        $data['brand'] = 'SIBUMDES';

        if ($_SESSION['username']) {
            $this->load->view('user/user_header', $data);
            $this->load->view('user/user_navside');
            $this->load->view('user/user_body');
            $this->load->view('user/user_footer');
        } else {
            redirect('unauthorized');
        }
    }
}
