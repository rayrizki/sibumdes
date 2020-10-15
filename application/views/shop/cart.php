<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9 order-2">
                <div class="row">
                    <div class="col-md-5">
                        <div class="fload-md-left mb-4">
                            <h2 class="h3 text-black">Keranjang</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around mb-5">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="detail_cart">
                        </tbody>
                    </table>
                    <?php if ($this->cart->contents()) { ?>
                        <a href="<?= base_url('shop/continueOrdering'); ?>" type="submit" class="btn btn-success btn-block continueOrdering">Lanjutkan Pemesanan</a>
                    <?php } else { ?>
                        <span class="btn btn-danger btn-block">Belum Ada Barang yang Dimasukan ke Keranjang</span>
                    <?php } ?>
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