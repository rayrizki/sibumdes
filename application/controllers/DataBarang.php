<?php
defined('BASEPATH') or exit('No direct access script allowed!');

class DataBarang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('databarang_model');
    }

    public function index()
    {
    }

    public function datatabungan()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Data Tabungan';

        if ($_SESSION['username']) {
            $this->load->view('user/user_header', $data);
            $this->load->view('user/user_navside');
            $this->load->view('data_barang/data_tabungan');
            $this->load->view('user/user_footer');
        } else {
            redirect('unauthorized');
        }
    }

    public function databarangprodukksapi()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Data Barang Produk Kotoran Sapi dan UMKM';

        if ($_SESSION['username']) {
            $this->load->view('user/user_header', $data);
            $this->load->view('user/user_navside');
            $this->load->view('data_barang/data_barangprodukksapi');
            $this->load->view('user/user_footer');
        } else {
            redirect('unauthorized');
        }
    }

    public function adddatabarang()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Data Barang Produk Kotoran Sapi dan UMKM';
        $this->databarang_model->adddatabarang();
        $this->session->set_flashdata('statusmessage', 'Success');
        redirect('databarangprodukksapi');
    }

    public function updatedatabarang()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Data Barang Produk Kotoran Sapi & UMKM';

        $this->databarang_model->updatedatabarang();
        $this->session->set_flashdata('statusmessageupdate', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil tambah data</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('databarangprodukksapi');
    }

    public function deletedatabarang()
    {
        if ($this->input->post('id')) {
            $result = $this->databarang_model->deletedatabarang($this->input->post('id'));
        }
    }

    public function getProductfromCB()
    {
        if ($this->input->post('productcode')) {
            $results = $this->databarang_model->getProductfromCB($this->input->post('productcode'));
            foreach ($results as $result) {
                $productname = strtoupper($result['product_name']);
                $amountofgoods = $result['amount_of_goods'];
            }
            echo json_encode(array("product_name" => $productname, "amountofgoods" => $amountofgoods));
        }
    }

    public function adddatatabungan()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Data Tabungan';
        $this->databarang_model->adddatatabungan();
        $this->session->set_flashdata('statusmessage', 'Success');
        redirect('datatabungan');
    }

    public function updatedatatabungan()
    {
        $data['brand'] = 'SIBUMDES';
        $data['title'] = 'Data Tabungan';

        $this->databarang_model->updatedatatabungan();
        $this->session->set_flashdata('statusmessageupdate', 'Success');
        redirect('databarangprodukksapi');
    }

    public function deletedatatabungan()
    {
        if ($this->input->post('id')) {
            $result = $this->databarang_model->deletedatatabungan($this->input->post('id'));
        }
    }

    public function getUserSavingsData()
    {
        if ($this->input->post('username')) {
            $results = $this->databarang_model->getUserSavingsData($this->input->post('username'));
            foreach ($results as $result) {
                $mdsavingsid = $result['id'];
                $amountofsavingsmd = $result['amount_of_savings'];
                $name = $result['name'];
                $phonenumber = $result['phone_number'];
                $address = strtoupper($result['address']);
            }
            echo json_encode(array("mdsavingsid" => $mdsavingsid, "amountofsavingsmd" => $amountofsavingsmd, "name" => $name, "phonenumber" => $phonenumber, "address" => $address));
        }
    }
}
