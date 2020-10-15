<?php
defined('BASEPATH') or exit('No direct access script allowed!');

class Masterdata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('masterdata_model');
    }

    public function produkkotoransapi()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Master Data Produk Kotoran Sapi & UMKM';

        if ($_SESSION['username']) {
            $this->load->view('user/user_header', $data);
            $this->load->view('user/user_navside', $data);
            $this->load->view('masterdata/masterdata_k_sapi');
            $this->load->view('user/user_footer');
        } else {
            redirect('unauthorized');
        }
    }

    public function addmdprodukkotoransapi()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Master Data Produk Kotoran Sapi & UMKM';

        // $this->form_validation->set_rules('productcode', 'Product code', 'trim|required');
        // $this->form_validation->set_rules('productname', 'Product Name', 'trim|required');
        // $this->form_validation->set_rules('price', 'Price', 'trim|required|integer');
        // $this->form_validation->set_rules('amountofgoods', 'Amount of Goods', 'trim|required|int');

        // if ($this->form_validation->run() == false) {
        //     $this->session->set_flashdata('statusmessage', '
        //     <div class="alert alert-warning alert-dismissible fade show" role="alert">
        //         <strong>Gagal tambah data</strong>, silakan coba tambah data kembali
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //         <span aria-hidden="true">&times;</span>
        //         </button>
        //     </div>');
        //     $this->load->view('user/user_header', $data);
        //     $this->load->view('user/user_navside', $data);
        //     $this->load->view('masterdata/masterdata_k_sapi');
        //     $this->load->view('user/user_footer');
        // } else {
        $this->masterdata_model->addmdprodukkotoransapi();
        $this->session->set_flashdata('statusmessage', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil tambah data</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('produkkotoransapi');
        //}
    }


    public function updateprodukkotoransapi()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Master Data Produk Kotoran Sapi & UMKM';

        // $this->form_validation->set_rules('uptproductcode', 'Product Code', 'trim|required');
        // $this->form_validation->set_rules('uptproductname', 'Product Name', 'trim|required');
        // $this->form_validation->set_rules('uptprice', 'Price', 'trim|required');

        // if ($this->form_validation->run() == false) {
        // $this->session->set_flashdata('statusmessage', '
        // <div class="alert alert-warning alert-dismissible fade show" role="alert">
        //     <strong>Gagal update data</strong>, silakan coba update data kembali
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //     </button>
        // </div>');
        // $this->load->view('user/user_header', $data);
        // $this->load->view('user/user_navside', $data);
        // $this->load->view('masterdata/masterdata_k_sapi');
        // $this->load->view('user/user_footer');
        // } else {
        $this->masterdata_model->updatemdprodukkotoransapi();
        $this->session->set_flashdata('statusmessageupdate', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil update data</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('produkkotoransapi');
        // }
    }

    public function deleteprodukkotoransapi()
    {
        if ($this->input->post('id')) {
            $result = $this->masterdata_model->deletedatamdpsapi($this->input->post('id'));
            // $this->session->set_flashdata('statusmessagedelete', '
            //     <div class="alert alert-warning alert-dismissible fade show" role="alert">
            //         <strong>Berhasil hapus data</strong>
            //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //         <span aria-hidden="true">&times;</span>
            //         </button>
            //     </div>');
            // redirect('produkkotoransapi');
        }
    }

    public function masterdatatabungan()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Master Data Tabungan';

        if ($_SESSION['username']) {
            $this->load->view('user/user_header', $data);
            $this->load->view('user/user_navside', $data);
            $this->load->view('masterdata/masterdata_tabungan');
            $this->load->view('user/user_footer');
        } else {
            redirect('unauthorized');
        }
    }

    public function addmdtabungan()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Master Data Tabungan';

        $this->masterdata_model->addmdtabungan();
        $this->session->set_flashdata('statusmessage', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil tambah data</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('masterdatatabungan');
    }

    public function updatemdtabungan()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Master Data Produk Kotoran Sapi & UMKM';

        $this->masterdata_model->updatemdtabungan();
        $this->session->set_flashdata('statusmessageupdate', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil tambah data</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('masterdatatabungan');
    }

    public function deleteMDTabungan()
    {
        if ($this->input->post('id')) {
            $result = $this->masterdata_model->deletedatamdtabungan($this->input->post('id'));
            // $this->session->set_flashdata('statusmessagedelete', '
            // <div class="alert alert-warning alert-dismissible fade show" role="alert">
            //     <strong>Berhasil hapus data</strong>
            //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //     <span aria-hidden="true">&times;</span>
            //     </button>
            // </div>');
            // redirect('masterdatatabungan');
        }
    }

    public function getUserFromCB()
    {
        if ($this->input->post('username')) {
            $results = $this->masterdata_model->getUserFromCB($this->input->post('username'));
            foreach ($results as $result) {
                $name = strtoupper($result['name']);
                $phonenumber = $result['phone_number'];
                $address = strtoupper($result['address']);
            }
            echo json_encode(array("name" => $name, "phonenumber" => $phonenumber, "address" => $address));
        }
    }
}
