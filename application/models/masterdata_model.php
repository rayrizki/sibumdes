<?php
defined('BASEPATH') or exit('No direct access script allowed!');

class masterdata_model extends CI_Model
{
    public function addmdprodukkotoransapi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d H:i:s');

        if (!empty($_FILES['foto_produk']['name'])) {
            $config['upload_path']  = './assets/img/upload/product/';
            $config['allowed_types']  = 'jpg|png';
            $config['file_name']  = htmlspecialchars($this->input->post('productname'));
            $config['overwrite']  = 'true';
            // $config['max_size']  = '1023';
            // $config['max_width'] = '';
            // $config['max_height'] = '';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_produk')) {
                $fotoproduk = $this->upload->data('file_name');
            } else {
                print_r($this->upload->display_errors());
                die;
            }
        } else {
            $fotoproduk = 'default_img_product.jpg';
        }

        $data = array(
            'id'                => '',
            'product_code'      => htmlspecialchars($this->input->post('productcode', true)),
            'product_name'      => htmlspecialchars($this->input->post('productname'), true),
            'category_id'       => htmlspecialchars($this->input->post('category_id', true)),
            'unit_id'           => htmlspecialchars($this->input->post('unit_id', true)),
            'price'             => htmlspecialchars($this->input->post('price', true)),
            'product_type_id'   => htmlspecialchars($this->input->post('product_type_id', true)),
            'amount_of_goods'   => htmlspecialchars($this->input->post('amountofgoods', true)),
            'product_information' => htmlspecialchars($this->input->post('productinformation', true)),
            'create_date'       => $createdate,
            'img_product'       => $fotoproduk,
            'is_sell'           => htmlspecialchars($this->input->post('item_status', true))
        );

        return $this->db->insert('md_product', $data);
    }

    public function updatemdprodukkotoransapi()
    {
        $productid = $this->input->post('productid');

        if (!empty($_FILES['foto_produk']['name'])) {

            if ($this->input->post('foto_produk_old') != 'default_img_product.jpg') {
                $filename = explode(".", $this->input->post('foto_produk_old'))[0];
                array_map('unlink', glob(FCPATH . "assets/img/upload/product/$filename.*"));
            }

            $config['upload_path']  = './assets/img/upload/product/';
            $config['allowed_types']  = 'jpg|png';
            $config['file_name']  = htmlspecialchars($this->input->post('productname'));
            $config['overwrite']  = 'true';
            // $config['max_size']  = '1023';
            // $config['max_width'] = '';
            // $config['max_height'] = '';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_produk')) {
                $fotoproduk = $this->upload->data('file_name');
            } else {
                print_r($this->upload->display_errors());
                die;
            }

            // echo "sukses";
            // die;
        } else {
            $fotoproduk = $this->input->post('foto_produk_old');
            // echo "tidak ada foto produk";
            // die;
        }

        $data = array(
            'product_code'      => htmlspecialchars($this->input->post('productcode', true)),
            'product_name'      => htmlspecialchars($this->input->post('productname'), true),
            'category_id'       => htmlspecialchars($this->input->post('categoryproduct', true)),
            'unit_id'           => htmlspecialchars($this->input->post('unitofgoods', true)),
            'price'             => htmlspecialchars($this->input->post('price', true)),
            'product_type_id'   => htmlspecialchars($this->input->post('producttype', true)),
            'product_information' => htmlspecialchars($this->input->post('productinformation', true)),
            'img_product'       => $fotoproduk,
            'is_sell'           => htmlspecialchars($this->input->post('itemstatus', true))
        );

        return $this->db->update('md_product', $data, array('id' => $productid));
    }

    public function deletedatamdpsapi($id)
    {

        if ($this->input->post('imgproduct') != 'default_img_product.jpg') {
            $filename = explode(".", $this->input->post('imgproduct'))[0];
            array_map('unlink', glob(FCPATH . "assets/img/upload/product/$filename.*"));
        }

        return $this->db->delete('md_product', array('id' => $id));
    }

    public function addmdtabungan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d H:i:s');

        $data = array(
            'id'                => '',
            'user_id'           => htmlspecialchars($this->input->post('username', true)),
            'name'              => htmlspecialchars($this->input->post('name'), true),
            'amount_of_savings' => htmlspecialchars($this->input->post('amountofsavings', true)),
            'create_date'       => $createdate,
            'is_active'         => htmlspecialchars($this->input->post('item_status', true)),
        );

        return $this->db->insert('md_savings', $data);
    }

    public function updatemdtabungan()
    {
        $userid = $this->input->post('userid');
        $data = array(
            'is_active'         => htmlspecialchars($this->input->post('itemstatus', true))
        );

        return $this->db->update('md_savings', $data, array('id' => $userid));
    }

    public function deletedatamdtabungan($id)
    {
        return $this->db->delete('md_savings', array('id' => $id));
    }

    public function getUserFromCB($id)
    {
        return $this->db->get_where('x_users', array('id' => $id))->result_array();
    }

    private function upload_img()
    {
        $config['upload_path']  = './assets/img/upload/';
        $config['allowed_type']  = 'jpg|png';
        $config['file_name']  = htmlspecialchars($this->input->post('productname'));
        $config['overwrite']  = 'true';
        $config['max_size']  = '1023';
        $config['max_width'] = '';
        $config['max_height'] = '';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }

        return "default_img_product.jpg";
    }
}
