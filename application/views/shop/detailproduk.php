<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9 order-2">
                <div class="row">
                    <div class="col-md-5">
                        <div class="fload-md-left mb-4">
                            <h2 class="h3 text-black">Detail Produk</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($detailproduct as $product) : ?>
                        <div class="col-md-4 mr-1 mb-4">
                            <img src="<?= base_url('assets/img/upload/product/' . $product['img_product']) ?>" class="img-fluid">
                        </div>
                        <div class="col-md-7">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Nama Produk</br>
                                    <span class="h4 text-black"><?= $product['product_name'] ?></span>
                                </li>
                                <li class="list-group-item">Harga</br>
                                    <span class="h4 text-black">Rp<?= $product['price'] ?></span>
                                </li>
                                <li class="list-group-item">Info Produk</br>
                                    <span class="h4 text-black">
                                        <?= $product['product_information'] == '' ? 'Tidak ada info produk' : $product['product_information'] ?></span>
                                </li>
                                <li class="list-group-item">Jumlah Produk Tersedia</br>
                                    <span class="h4 text-black">
                                        <?= $product['amount_of_goods'] == '0' ? 'Produk tidak tersedia' : $product['amount_of_goods'] ?>
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group mt-2">
                                        <select class="custom-select" id="<?= $product['id'] ?>">
                                            <?php $amount = $product['amount_of_goods'];
                                            for ($value = 0; $value <= $amount; $value++) { ?>
                                                <option value="<?= $value ?>"><?= $value ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="input-group-append">
                                            <?php if ($product['amount_of_goods'] == 0) { ?>
                                                <span class="btn btn-warning">Barang Belum Tersedia<i class="fas fa-shopping-cart"></i></span>
                                            <?php } else { ?>
                                                <a href="javascript:void(0)" class="btn btn-success add_cart_2" data-getid="<?= $product['id'] ?>" data-getproductname="<?= $product['product_name'] ?>" data-getprice="<?= $product['price'] ?>">Tambah ke Keranjang<i class="fas fa-cart-plus"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
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