<?php
defined('BASEPATH') or exit('No direct script access allowed!');

class shop_model extends CI_Model
{
    public function getdetailproduk($id)
    {
        return $this->db->get_where('md_product', array('id' => $id))->result_array();
    }

    public function getdetailprodukkategori($id)
    {
        if ($id == 0) {
            return $this->db->get('md_product')->result_array();
        } else {
            return $this->db->get_where('md_product', array('product_type_id' => $id))->result_array();
        }
    }

    public function order($detail_produk)
    {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d H:i:s');

        $data_customers = array(
            'id'                => '',
            'user_status_id'    => 1,
            'customer_name'     => htmlspecialchars($this->input->post('full_name'), true),
            'customer_contact'  => htmlspecialchars($this->input->post('email', true)),
            'customer_email'    => htmlspecialchars($this->input->post('handphone_number', true)),
            'customer_address'  => htmlspecialchars($this->input->post('address', true)),
            'urban_village'     => htmlspecialchars($this->input->post('urban_village', true)),
            'sub_district'      => htmlspecialchars($this->input->post('sub_district', true)),
            'city'              => htmlspecialchars($this->input->post('city', true)),
            'postal_code'       => htmlspecialchars($this->input->post('postal_code', true)),
            'create_date'       => $createdate
        );

        // $this->db->insert('x_customers', $data_customers);

        $this->db->select_max('id');
        $query = $this->db->get('x_customers')->result_array();

        foreach ($query as $key) {
            $customer_id = $key['id'];
        }

        foreach ($this->cart->contents() as $value) {

            $no = 0;

            date_default_timezone_set('Asia/Jakarta');
            $nosales = date('YmdHis') + $no;

            $data_sales = array(
                'id'                => '',
                'no_sales'          => $nosales,
                'product_id'        => $value['id'],
                'customer_id'       => $customer_id,
                'product_name'      => $value['name'],
                'amount_of_goods'   => $value['qty'],
                'amount_of_price'   => $value['subtotal'],
                'purchase_date'     => $createdate,
            );

            // $this->db->insert('product_sales', $data_sales);
            // $this->cart->destroy();
        }
        // $this->sendEmail($nosales, htmlspecialchars($this->input->post('full_name'), true), $detail_produk);
        return $nosales;
    }

    private function sendEmail($nosales, $name, $detail_produk)
    {
        $from_email = 'rayrizki19@gmail.com';
        $to_email   = htmlspecialchars($this->input->post('email', true));

        $this->load->library('email');

        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => $from_email,
            'smtp_pass' => 'evilwater921',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
        );

        $this->email->initialize($config);

        $this->email->set_newline("\r\n");

        $this->email->from($from_email, 'SIBUMDES CIBOGO');
        $this->email->to($to_email);
        $this->email->subject('[SIBUMDES] Kode Transaksi Pembelian');
        $this->email->message('<p>Hallo, ' . $name . '</p><p>Terima kasih sudah membeli barang di Sibumdes Shop, untuk melanjutkan transaksi, silakan menghubungi Admin Sibumdes melalui pesan chat Whastapp dengan menyertakan nomor transaki yang terlampir.</p><p>Nomor Transaksi Anda ' . $nosales . '</p><b>Detail Produk</b></br><thead>
        <tr>
            <td>No.</td>
            <td>Produk</td>
            <td>Harga</td>
            <td>Quantity</td>
            <td>Sub Total</td>            
        </tr>
    </thead>' . $detail_produk . '<p>Terima kasih</p>');

        if ($this->email->send()) {
            $this->session->set_flashdata('notif', 'Kode Transaksi Beserta Detail Produk Barang yang Dipesan Sudah Dikirim ke Email ' . $to_email);
        } else {
            $notifGagal = $this->email->print_debugger();
            $this->session->set_flashdata('notif', $notifGagal);
        }
    }
}
