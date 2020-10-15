<?php
defined('BASEPATH') or exit('No direct access script allowed');

class shop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shop_model');
    }

    public function index()
    {
        $this->load->view('shop/shop_header');
        $this->load->view('shop/shop');
        $this->load->view('shop/shop_footer');
    }

    public function detailproduk($id)
    {

        $data['detailproduct'] = $this->shop_model->getdetailproduk($id);

        $this->load->view('shop/shop_header');
        $this->load->view('shop/detailproduk', $data);
        $this->load->view('shop/shop_footer');
    }

    public function detailprodukkategori($id)
    {
        $data['detailproductcategory'] = $this->shop_model->getdetailprodukkategori($id);

        $this->load->view('shop/shop_header');
        $this->load->view('shop/seeitem', $data);
        $this->load->view('shop/shop_footer');
    }

    public function cart()
    {
        $this->load->view('shop/shop_header');
        $this->load->view('shop/cart');
        $this->load->view('shop/shop_footer');
    }


    public function addToCart()
    {
        $data = array(
            'id' => $this->input->post('product_id'),
            'name' => $this->input->post('product_name'),
            'price' => $this->input->post('price'),
            'qty' => $this->input->post('quantity')
        );

        $this->cart->insert($data);
    }

    public function showCart()
    {
        $output = '';
        $no = '';

        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .= '
                <tr>
                    <td>' . $no . '</td>
                    <td>' . $items['name'] . '</td>
                    <td>' . number_format($items['price']) . '</td>
                    <td>' . $items['qty'] . '</td>
                    <td>' . number_format($items['subtotal']) . '</td>
                    <td><button type="button" id="' . $items['rowid'] . '" class="btn btn-danger deleteCart">Hapus</button>                    
                </tr>
            ';
        }

        $output .= '
            <tr>
                <th></th>
                <th colspan = "3">Total</th>
                <th colspan = "2">Rp' . number_format($this->cart->total()) . '</th>
            </tr>
        ';

        return $output;
    }

    public function showCartOrdering()
    {
        $output = '';
        $no = '';

        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .= '
                <tr>
                    <td>' . $no . '</td>
                    <td>' . $items['name'] . '</td>
                    <td>' . number_format($items['price']) . '</td>
                    <td style="text-align:center">' . $items['qty'] . '</td>
                    <td>' . number_format($items['subtotal']) . '</td>                    
                </tr>
            ';
        }

        $output .= '
            <tr>
                <th colspan = "3">Total</th>
                <th colspan = "2">Rp' . number_format($this->cart->total()) . '</th>
            </tr>
        ';

        return $output;
    }

    public function loadCart()
    {
        echo $this->showCart();
    }

    public function loadCartOrdering()
    {
        echo $this->showCartOrdering();
    }

    public function deleteCart()
    {
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'qty' => 0
        );

        $this->cart->update($data);
        echo $this->showCart();
    }
    public function continueOrdering()
    {
        $this->load->view('shop/shop_header');
        $this->load->view('shop/continue_ordering');
        $this->load->view('shop/shop_footer');
    }

    public function order()
    {
        $this->form_validation->set_rules(
            'full_name',
            'Nama',
            'trim|required',
            [
                'required' => 'Nama Lengkap Tidak Boleh Kosong'
            ]
        );
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules(
            'handphone_number',
            'Nomor Handphone',
            'trim|required|integer',
            [
                'required' => 'Nomor Handphone Tidak Boleh Kosong'
            ]
        );
        $this->form_validation->set_rules(
            'address',
            'Alamat',
            'trim|required',
            [
                'required' => 'Alamat Tidak Boleh Kosong'
            ]
        );
        $this->form_validation->set_rules('province', 'Provinsi', 'trim|required', [
            'required' => 'Provinsi Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('sub_district', 'Kecamatan', 'trim|required', [
            'required' => 'Kecamatan Tidak Boleh Kosong'
        ]);
        $this->form_validation->set_rules('city', 'Kabupaten/Kota', 'trim|required', [
            'required' => 'Kabupaten/Kota Tidak Boleh Kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('shop/shop_header');
            $this->load->view('shop/continue_ordering');
            $this->load->view('shop/shop_footer');
        } else {
            $data['nosales'] = $this->shop_model->order($this->showCartOrdering());
            $this->load->view('shop/shop_header');
            $this->load->view('shop/success_order', $data);
            $this->load->view('shop/shop_footer');
        }
    }

    public function getCity($param)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $param,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 3c60f8a06b6baf6e3e3fd59502494a72"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $city = json_decode($response, true);

            if ($city['rajaongkir']['status']['code'] == 200) {
                foreach ($city['rajaongkir']['results'] as $value) {
                    echo "<option value='$value[city_id]'>$value[type] $value[city_name]</option>";
                }
            }
        }
    }

    public function getCityFirst()
    {
        $output_city = 'Fail';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 3c60f8a06b6baf6e3e3fd59502494a72"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $city = json_decode($response, true);

            if ($city['rajaongkir']['status']['code'] == 200) {
                foreach ($city['rajaongkir']['results'] as $value) {
                    $output_city .= "<option value='$value[city_id]'>$value[city_name]</option>";
                }
            }
        }
        return $output_city;
    }

    public function showCity()
    {
        echo $this->getCityFirst();
    }

    public function checkCost()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=24&destination=" . $this->input->post('city') . "&weight=" . $this->input->post('weight_product') . "&courier=" . $this->input->post('courier'),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 3c60f8a06b6baf6e3e3fd59502494a72"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $detail_cost = '';
            $cost = json_decode($response, true);

            if ($cost['rajaongkir']['status']['code'] == 200) {
                foreach ($cost['rajaongkir']['results'][0]['costs'] as $value) {
                    $detail_cost .= '<div class="card">
                    <div class="card-header">
                      Detail Ongkos Kirim
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">' . $value['service'] . '</h5>
                      <p class="card-text">' . $value['description'] . '</p>
                      <p class="card-text">' . number_format($value['cost'][0]['value']) . '</p>
                    </div>
                    <div class="card-footer text-muted">
                      waktu estimasi pengiriman ' . $value['cost'][0]['etd'] . '
                    </div>
                  </div>';
                }
            }
        }
        return $detail_cost;
    }

    public function viewCheckCost()
    {
        echo $this->checkCost();
    }
}
