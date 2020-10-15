<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9 order-2">
                <div class="row">
                    <div class="col-md-5">
                        <div class="fload-md-left mb-4">
                            <h2 class="h3 text-black">Belanja</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around mb-5" id="stayhere">
                    <?php foreach ($detailproductcategory as $product) : ?>
                        <div class="col-md-3 mr-1 mb-4">
                            <div id="stayhere" class="card" style="width: 255px;">
                                <img src="<?= base_url('assets/img/upload/product/' . $product['img_product']) ?>" class="card-img-top rounded" style="width: 255px; height: 200px">
                                <div class="card-body">
                                    <h5 class="card-title text-center text-black"><?= $product['product_name'] ?><a href="<?= base_url('shop/detailproduk/') . $product['id'] ?>" class="btn-outline-info btn-sm"><i class="fas fa-info-circle"></i></a></h5>
                                    <p class="card-text text-center text-black">Rp<?= $product['price'] ?></p>
                                    <p class="card-text text-center text-black">Jumlah Barang Tersedia <span class="badge badge-pill badge-info"><?= $product['amount_of_goods'] ?></p></span>
                                    <select class="custom-select" id="<?= $product['id'] ?>">
                                        <?php $amount = $product['amount_of_goods'];
                                        for ($value = 0; $value <= $amount; $value++) { ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if ($product['amount_of_goods'] == 0) { ?>
                                        <span class="btn btn-warning btn-block">Barang Belum Tersedia<i class="fas fa-shopping-cart"></i></span>
                                    <?php } else { ?>
                                        <a href="javascript:void(0)" class="btn btn-success btn-block add_cart_2" data-getid="<?= $product['id'] ?>" data-getproductname="<?= $product['product_name'] ?>" data-getprice="<?= $product['price'] ?>">Tambah ke Keranjang<i class="fas fa-cart-plus"></i></a>
                                        <p id="itemsnotfilled" class="text-small text-danger"></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="site-block-27">
                            <ul>
                                <li><a href="#">&lt;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">&gt;</a></li>
                            </ul>
                        </div>
                    </div>
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