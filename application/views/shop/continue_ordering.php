<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 60,
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
    $provinsi = json_decode($response, true);
}
?>
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9 order-2">
                <div class="row">
                    <div class="col-md-5">
                        <div class="fload-md-left mb-4">
                            <h2 class="h3">Lanjutkan Pemesanan</h2>
                        </div>
                    </div>
                </div>
                <div class="row ml-1 mb-5">
                    <div class="col-12">
                        <?= form_open('shop/order') ?>
                        <div class="form-group">
                            <label for="name" class=" text-black">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="full_name">
                            <?php if (form_error('full_name')) :
                                echo form_error('full_name', '<small class="small text-danger">', '</small>');
                            endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-black">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <p class="text-sm text-danger">*kode transaksi akan dikirimkan melalui email</p>
                            <?php if (form_error('email')) :
                                echo form_error('email', '<small class="small text-danger">', '</small>');
                            endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="handphone_number" class="text-black">Nomor Handphone</label>
                            <input type="text" class="form-control" id="handphone_number" name="handphone_number">
                            <?php if (form_error('handphone_number')) :
                                echo form_error('handphone_number', '<small class="small text-danger">', '</small>');
                            endif; ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="province" class="text-black">Provinsi</label>
                                <select class="form-control" id="province" name="province">
                                    <?php
                                    if ($provinsi['rajaongkir']['status']['code'] == 200) :
                                        foreach ($provinsi['rajaongkir']['results'] as $value) : ?>
                                            <option value="<?= $value['province_id'] ?>"><?= $value['province'] ?></option>
                                    <?php endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="city" class="text-black">Kabupaten/Kota</label>
                                <select class="form-control" id="city" name="city">
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="kecamatan" class=" text-black">Kecamatan</label>
                                <input type="text" class="form-control" id="sub_district" name="sub_district">
                                <?php if (form_error('sub_district')) :
                                    echo form_error('sub_district', '<small class="small text-danger">', '</small>');
                                endif; ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="address" class=" text-black">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address">
                                <?php if (form_error('address')) :
                                    echo form_error('address', '<small class="small text-danger">', '</small>');
                                endif; ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="postal_code" class=" text-black">Kode Pos</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code">
                                <?php if (form_error('postal_code')) :
                                    echo form_error('postal_code', '<small class="small text-danger">', '</small>');
                                endif; ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="ekspedisi" class="text-black">Ekspedisi</label>
                                <select class="form-control" id="courier" name="courier">
                                    <?php $ekspedisi = ['jne' => 'JNE', 'pos' => 'POS', 'tiki' => 'TIKI'];
                                    foreach ($ekspedisi as $key => $value) : ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                    <?php endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="weight_product" class="text-black">Berat(gram)</label>
                                <input type="text" class="form-control" id="weight_product" name="weight_product" value="500" disabled>
                            </div>
                        </div>
                        <a class="btn btn-info mb-5 text-white" id="check_cost">Cek Biaya Ekspedisi</a>
                        <div id="detail_cost">
                        </div>
                        <p class="mt-5 mb-3 h3">
                            Keranjang Anda
                        </p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="detail_cart_ordering">
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success btn-block">Pesan Sekarang</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <div class="col-md-3 order-1 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">
                        Kategori
                    </h3>
                    <?php

                    $queryJumlahProdukKategori = "SELECT b.product_type_id, b.name, count(*) AS 'jumlah'
                                            FROM md_product a RIGHT JOIN product_type b
                                            ON a.product_type_id = b.product_type_id
                                            GROUP BY b.product_type_id, b.name";

                    $queryJumlahProduk = "SELECT count(*) AS 'jumlah'
                                            FROM md_product";

                    $query = $this->db->query($queryJumlahProdukKategori)->result_array();
                    $queryData = $this->db->query($queryJumlahProduk)->result_array();

                    ?>
                    <ul class="list-unstyled mb-0">
                        <?php foreach ($query as $jumlahproduk) : ?>
                            <li class="mb-1"><a href="<?= base_url('shop/detailprodukkategori/') . $jumlahproduk['product_type_id'] ?>" class="d-flex"><?= $jumlahproduk['name'] ?><span class="text-black ml-auto"><?= $jumlahproduk['jumlah'] ?></span></a></li>
                        <?php endforeach; ?>
                        <?php foreach ($queryData as $jumlahproduk) : ?>
                            <li class="mb-1"><a href="<?= base_url('shop/detailprodukkategori/0') ?>" class="d-flex">Semua Barang<span class="text-black ml-auto"><?= $jumlahproduk['jumlah'] ?></span></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>