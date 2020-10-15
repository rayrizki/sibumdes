<?php
defined('BASEPATH') or exit('No direct access script allowed!');

class Userrequest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('userrequest_model');
    }

    public function requestjemputbarang()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Request Penjemputan Barang';
        $data['user_id'] = $_SESSION['id'];

        if ($_SESSION['username']) {
            $this->load->view('user/user_header', $data);
            $this->load->view('user/user_navside');
            $this->load->view('user_request/requestjemputbarang');
            $this->load->view('user/user_footer');
        } else {
            redirect('unauthorized');
        }
    }

    public function addrequestjemputbarang()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Request Jemput Barang';
        $this->userrequest_model->addrequestjemputbarang();
        $this->session->set_flashdata('statusmessage', 'Success');
        redirect('requestjemputbarang');
    }

    public function getDataUser()
    {
        if ($this->input->post('userid')) {
            $results = $this->userrequest_model->getDataUser($this->input->post('userid'));
            foreach ($results as $result) {
                $userid = $result['id'];
                $requesttypeid = $result['request_type_id'];
                $username = strtoupper($result['username']);
                $name = strtoupper($result['name']);
                $phonenumber = $result['phone_number'];
                $address = strtoupper($result['address']);
                $requesttypename = strtoupper($result['request_type_name']);
            }
            echo json_encode(array("userid" => $userid, "requesttypeid" => $requesttypeid, "username" => $username, "name" => $name, "phonenumber" => $phonenumber, "address" => $address, "requesttypename" => $requesttypename));
        }
    }

    public function approvalpenjemputanbarang()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Approval Penjemputan Barang';

        if ($_SESSION['username']) {
            $this->load->view('user/user_header', $data);
            $this->load->view('user/user_navside');
            $this->load->view('user_request/approvaljemputbarang');
            $this->load->view('user/user_footer');
        } else {
            redirect('unauthorized');
        }
    }

    public function updateapprovalpenjemputanbarang()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Approval Penjemputan Barang';

        $this->userrequest_model->updateapprovalpenjemputanbarang();
        $this->session->set_flashdata('statusmessageupdate', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil tambah data</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('approvalpenjemputanbarang');
    }
}
