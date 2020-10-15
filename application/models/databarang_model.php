<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class databarang_model extends CI_Model
{
    public function adddatabarang()
    {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d H:i:s');

        $jumlahbarang = htmlspecialchars($this->input->post('jumlahbarang', true));
        $jumlahbarangmd = htmlspecialchars($this->input->post('jumlahbarangmd', true));
        $amountofgoods = $jumlahbarang + $jumlahbarangmd;

        $data = array(
            'id'             => '',
            'product_id'     => htmlspecialchars($this->input->post('product_id', true)),
            'product_name'   => htmlspecialchars($this->input->post('productname'), true),
            'amount_of_goods' => htmlspecialchars($this->input->post('jumlahbarang', true)),
            'input_date'    => $createdate,
        );

        $datamd = array(
            'amount_of_goods' => $amountofgoods
        );

        $this->db->update('md_product', $datamd, array('id' => htmlspecialchars($this->input->post('product_id', true))));
        $this->db->insert('product_inventory', $data);
    }

    public function updatedatabarang()
    {
        $productid = htmlspecialchars($this->input->post('idbarang', true));
        $productidmd = htmlspecialchars($this->input->post('idmd', true));
        $jumlahbarang = htmlspecialchars($this->input->post('jumlahbarang', true));
        $jumlahbarangmd = htmlspecialchars($this->input->post('jumlahbarangmd', true));
        $newjumlahbarang = htmlspecialchars($this->input->post('newjumlahbarang', true));

        if ($jumlahbarang > $newjumlahbarang) {
            $result = $jumlahbarang - $newjumlahbarang;
            $jumlahbarangmd = $jumlahbarangmd - $result;
        } elseif ($jumlahbarang < $newjumlahbarang) {
            $result = $newjumlahbarang - $jumlahbarang;
            $jumlahbarangmd = $jumlahbarangmd + $result;
        }

        $databarang = array(
            'amount_of_goods' => $newjumlahbarang
        );

        $datamdbarang = array(
            'amount_of_goods' => $jumlahbarangmd
        );

        $this->db->update('product_inventory', $databarang, array('id' => $productid));
        $this->db->update('md_product', $datamdbarang, array('id' => $productidmd));
    }

    public function deletedatabarang($id)
    {
        return $this->db->delete('product_inventory', array('id' => $id));
    }

    public function getProductfromCB($product_code)
    {
        return $this->db->get_where('md_product', array('id' => $product_code))->result_array();
    }


    public function adddatatabungan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d H:i:s');

        $jumlahtabungan = htmlspecialchars($this->input->post('amountofsavings', true));
        $jumlahtabunganmd = htmlspecialchars($this->input->post('amountsavingsmd', true));
        $newjumlahtabungan = $jumlahtabungan + $jumlahtabunganmd;

        $data = array(
            'id'                => '',
            'md_savings_id'     => htmlspecialchars($this->input->post('mdsavingsid', true)),
            'name'              => htmlspecialchars($this->input->post('name'), true),
            'amount_of_savings' => htmlspecialchars($this->input->post('amountofsavings', true)),
            'savings_date'      => $createdate,
        );

        $datamd = array(
            'amount_of_savings' => $newjumlahtabungan
        );

        $this->db->update('md_savings', $datamd, array('id' => htmlspecialchars($this->input->post('mdsavingsid', true))));
        $this->db->insert('savings_data', $data);
    }

    public function updatedatatabungan()
    {
        $idtabungan = htmlspecialchars($this->input->post('idtabungan', true));
        $idmdtabungan = htmlspecialchars($this->input->post('idmdtabungan', true));
        $jumlahtabunganlama = htmlspecialchars($this->input->post('jumlahtabunganlama', true));
        $jumlahtabunganmd = htmlspecialchars($this->input->post('jumlahtabunganmd', true));
        $jumlahtabungan = htmlspecialchars($this->input->post('jumlahtabungan', true));

        if ($jumlahtabunganlama > $jumlahtabungan) {
            $result = $jumlahtabunganlama - $jumlahtabungan;
            $jumlahtabunganmd = $jumlahtabunganmd - $result;
        } elseif ($jumlahtabunganlama < $jumlahtabungan) {
            $result = $jumlahtabungan - $jumlahtabunganlama;
            $jumlahtabunganmd = $jumlahtabunganmd + $result;
        }

        $datatabungan = array(
            'amount_of_savings' => $jumlahtabungan
        );

        $datamdtabungan = array(
            'amount_of_savings' => $jumlahtabunganmd
        );

        $this->db->update('md_savings', $datamdtabungan, array('id' => $idmdtabungan));
        $this->db->update('savings_data', $datatabungan, array('id' => $idtabungan));
    }

    public function deletedatatabungan($id)
    {
        return $this->db->delete('savings_data', array('id' => $id));
    }

    public function getUserSavingsData($user_id)
    {
        $query = "SELECT a.id, a.amount_of_savings, b.name, b.phone_number, b.address
                    FROM md_savings a INNER JOIN x_users b
                    ON a.user_id = b.id
                    WHERE a.user_id = $user_id";

        return $this->db->query($query)->result_array();
    }
}
