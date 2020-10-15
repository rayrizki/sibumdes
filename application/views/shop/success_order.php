<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9 order-2">
                <div class="row">
                    <div class="col-md-5">
                        <div class="fload-md-left mb-4">
                            <h2 class="h3">Info</h2>
                        </div>
                    </div>
                </div>
                <div class="row ml-1 mb-5">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Transaksi Berhasil Disimpan</h4>
                        <p>Transaksi Anda berhasil disimpan dengan kode transaksi <a href="" class="alert-link"><?= $nosales; ?></a>, silakan menghubungi admin melalui whatsapp untuk proses selanjutnya dengan melampirkan kode transaksi.</p>
                        <hr>
                        <p class="mb-0">Terima kasih.</p>
                    </div>
                    <?php
                    if ($this->session->flashdata('notif')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= $this->session->flashdata('notif') ?>
                        </div>
                    <?php endif; ?>
                    <a href='https://api.whatsapp.com/send?phone=+62895323493990&text=Hallo,%20Admin%0ASaya%20ingin%20melanjutkan%20proses%20transaksi%20pembelian%20barang%20melalui%20Sibumdes%20Shop%20dengan%20kode%20transaksi%0ATerima kasih' target="_blank" class="btn btn-success btn-block text-white">Hubungi Admin Sekarang?</a>
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