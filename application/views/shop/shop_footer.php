<footer class="site-footer border-top">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-3">
                <h3 class="footer-heading mb-4">Navigasi</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 col-lg-3">
                <h3 class="footer-heading mb-3">Info Kontak</h3>
                <ul class="nav flex-column">
                    <li class="nav-link"><i class="fas fa-phone-square-alt"></i> 085222321517</a></li>
                    <li class="nav-link"><i class="far fa-envelope"></i> desacibogo@gmail.com</li>
                </ul>
            </div>
            <div class="col-md-4 offset-md-1">
                <li>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31693.57701774609!2d107.62102985352124!3d-6.806649005415063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e0f0425954bf%3A0x33d3f38a73ae0d88!2sKantor%20Kepala%20Desa%20Cibogo!5e0!3m2!1sid!2sid!4v1600054109807!5m2!1sid!2sid" width="330" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </li>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 pt-3">
                <p class="text-black">&copy; BUMDES CIBOGO 2020</p>
            </div>
        </div>
    </div>
</footer>
<a href="https://api.whatsapp.com/send?phone=+62895323493990&text=Hallo,%20Admin%0ASaya ingin menanyakan " target="_blank">
    <div style="position:fixed; width:71px; height:71px; left:20px; bottom:20px; background-color:#25D366" class="rounded-circle text-center pt-2">
        <i class="fab fab fa-whatsapp fa-3x mt-1"></i>
        <!-- <span class="text-white align-middle font-weight-bolder">Hubungi kami</span> -->
    </div>
</a>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url(); ?>assets/js/scripts.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery-ui.js"></script>
<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {

        $('.owl-carousel').owlCarousel({
            // loop: true,
            // margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 3
                }
            }
        })
    })

    $(document).ready(function() {
        document.getElementById("province").addEventListener('change', function() {
            fetch("<?= base_url('shop/getCity/') ?>" + this.value, {
                    method: 'GET'
                })
                .then((response) => response.text())
                .then((data) => {
                    document.getElementById("city").innerHTML = data
                })
        })
    })

    $(document).ready(function() {
        $('#city').load('showCity');
    })

    $(document).ready(function() {
        $("#check_cost").click(function() {
            var city = document.getElementById('city').value;
            var courier = document.getElementById('courier').value;
            var weight_product = document.getElementById('weight_product').value;

            $.ajax({
                url: 'viewCheckCost',
                method: 'POST',
                dataType: 'json',
                data: {
                    city: city,
                    courier: courier,
                    weight_product: weight_product
                },
                succes: function(data) {
                    $('#detail_cost').html(data);
                    console.log(data);
                },
            })
        })
    })
</script>

</body>

</html>