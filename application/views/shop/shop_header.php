<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIBUMDES SHOP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Font Awesome-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/styleshop.css">

</head>

<body>
    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            <div class="site-navbar-top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="text-left h4 font-weight-bolder">SIBUMDES SHOP</li>
                        </div>
                        <div class="col text-right">
                            <div class="site-top-icons">
                                <?php
                                $quantity = 0;

                                foreach ($this->cart->contents() as $items) {
                                    $quantity += $items['qty'];
                                }
                                ?>
                                <ul>
                                    <a href="<?= base_url('shop/cart') ?>" class="site-cart">
                                        <li>Keranjang</li>
                                        <li>
                                            <span class="fas fa-shopping-cart"></span>
                                            <span class="count"><?= $quantity; ?></span>
                                    </a>
                                    </li>
                                    <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="site-navigation text-right text-md-center" role="navigation">
                <div class="container">
                    <ul class="site-menu js-clone-nav d-none d-md-block">
                        <li><a href="<?= base_url() ?>shop">
                                <h6>Home</h6>
                            </a></li>
                        <li><a href="<?= base_url() ?>shop/detailprodukkategori/0">
                                <h6>Shop</h6>
                            </a></li>
                        <li><a href="<?= base_url() ?>shop/cart">
                                <h6>Cart</h6>
                            </a></li>
                        <li><a href="#">
                                <h6>About</h6>
                            </a></li>
                        <li><a href="#">
                                <h6>Contact</h6>
                            </a></li>
                    </ul>
                </div>
            </nav>
        </header>