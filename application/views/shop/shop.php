    <div class="site-blocks-cover" style="background: url(<?= base_url('assets/img/background-ecommerce.jpg'); ?>);">
      <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
          <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
            <h1 class="mb-2">Temukan Barang, Di sini</h1>
            <div class="intro-text text-center text-md-left">
              <p class="mb-4">
              </p>
              <p>
                <a href="<?= base_url(); ?>shop/detailprodukkategori/0" class="btn btn-lg btn-primary">Belanja Sekarang</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm site-blocks-1">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4">
            <div class="icon mr-4 align-self-start">
              <span class="far fa-thumbs-up fa-2x"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Barang Berkualitas</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
            </div>
          </div>
          <!-- <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4">
            <div class="icon mr-4 align-self-start">
              <span class="icon-refresh2"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Free Returns</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
            </div>
          </div> -->
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4">
            <div class="mr-4 align-self-start">
              <span class="fas fa-headset fa-2x"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Customer Support</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer accumsan tincidunt fringilla.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Produk Unggulan</h2>
          </div>
        </div>
        <?php

        $queryFeaturedProduct = "SELECT a.id, a.product_name, a.amount_of_goods, a.price, a.img_product, 
                                  SUM(b.amount_of_goods)
                                  FROM md_product a LEFT JOIN product_sales b
                                  ON a.id = b.product_id
                                  GROUP BY a.id, a.product_name, a.amount_of_goods, a.price, a.img_product
                                  ORDER BY b.amount_of_goods
                                  LIMIT 3";

        $query = $this->db->query($queryFeaturedProduct)->result_array();

        ?>
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="owl-carousel owl-theme">
              <?php foreach ($query as $product) : ?>
                <div class="card" style="width: 330px;">
                  <img src=" <?= base_url('assets/img/upload/product/' . $product['img_product']) ?>" class="card-img-top rounded" style="width: 330px; height: 247px">
                  <div class="card-body text-center">
                    <h5 class="card-title text-center text-black"><?= strtoupper($product['product_name']) ?><a href="<?= base_url('shop/detailproduk/') . $product['id'] ?>" class="btn-outline-info btn-sm"><i class="fas fa-info-circle"></i></a></h5>
                    <p class="card-text text-center text-black ">Rp<?= number_format($product['price']) ?></p>
                    <p class="card-text text-center text-black">Jumlah Barang Tersedia <span class="badge badge-pill badge-info"><?= $product['amount_of_goods'] ?></p></span>
                    <div class="input-group">
                      <select class="custom-select" id="<?= $product['id'] ?>">
                        <?php $amount = $product['amount_of_goods'];
                        for ($value = 0; $value <= $amount; $value++) { ?>
                          <option value="<?= $value ?>"><?= $value ?></option>
                        <?php } ?>
                      </select>
                      <div class="input-group-append">
                        <?php if ($product['amount_of_goods'] == 0) { ?>
                          <span class="btn btn-warning btn-sm">Barang Belum Tersedia<i class="fas fa-shopping-cart"></i></span>
                        <?php } else { ?>
                          <a href="javascript:void(0)" class="btn btn-success btn-sm add_cart" data-getid="<?= $product['id'] ?>" data-getproductname="<?= $product['product_name'] ?>" data-getprice="<?= $product['price'] ?>">Tambah ke Keranjang<i class="fas fa-cart-plus"></i></a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>