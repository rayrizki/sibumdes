/*!
    * Start Bootstrap - SB Admin v6.0.0 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
    */
(function ($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // // Toggle the side navigation
    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

(function () {
    'use strict';

    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('MDValidation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() == false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$(document).ready(function () {
    $(".addnewdata").click(function () {
        var username = $('#username').val();

        $.ajax({
            type: "post",
            url: "Masterdata/getUserFromCB",
            data: { username: username },
            dataType: 'json',
            success: function (result) {
                $('#name').val(result.name);
                $('#phonenumber').val(result.phonenumber);
                $('#address').val(result.address);
            }
        });
    });
});

$(document).ready(function () {
    $("#productcode").change(function () {
        var productcode = $('#productcode').val();

        $.ajax({
            type: "post",
            url: "databarang/getProductfromCB",
            data: { productcode: productcode },
            dataType: 'json',
            success: function (result) {
                $('#productname').val(result.product_name);
                $('#jumlahbarangmd').val(result.amountofgoods);
            }
        })
    })
})


$(document).ready(function () {
    $(".addnewdatabarang").click(function () {
        var productcode = $('#productcode').val();

        $.ajax({
            type: "post",
            url: "databarang/getProductfromCB",
            data: { productcode: productcode },
            dataType: 'json',
            success: function (result) {
                $('#productname').val(result.product_name);
                $('#jumlahbarangmd').val(result.amountofgoods);
            }
        })
    })
})

$(document).ready(function () {
    $("#username").change(function () {

        var username = $('#username').val();

        $.ajax({
            type: "post",
            url: "Masterdata/getUserFromCB",
            data: { username: username },
            dataType: 'json',
            success: function (result) {
                $('#name').val(result.name);
                $('#phonenumber').val(result.phonenumber);
                $('#address').val(result.address);
            }
        });
    });
});

$(document).ready(function () {
    $(".addnewsavingsdata").click(function () {
        var username = $('#user').val();

        $.ajax({
            type: "post",
            url: "DataBarang/getUserSavingsData",
            data: { username: username },
            dataType: 'json',
            success: function (result) {
                $("#mdsavingsid").val(result.mdsavingsid);
                $("#amountsavingsmd").val(result.amountofsavingsmd);
                $('#name').val(result.name);
                $('#phonenumber').val(result.phonenumber);
                $('#address').val(result.address);
            }
        });
    });
});

$(document).ready(function () {
    $("#user").change(function () {
        var username = $('#user').val();

        $.ajax({
            type: "post",
            url: "DataBarang/getUserSavingsData",
            data: { username: username },
            dataType: 'json',
            success: function (result) {
                $("#mdsavingsid").val(result.mdsavingsid);
                $("#amountsavingsmd").val(result.amountofsavingsmd);
                $('#name').val(result.name);
                $('#phonenumber').val(result.phonenumber);
                $('#address').val(result.address);
            }
        });
    });
});

$(document).ready(function () {
    $(".addnewrequest").click(function () {
        var userid = $('#userid').val();

        $.ajax({
            type: "post",
            url: "Userrequest/getDataUser",
            data: { userid: userid },
            dataType: 'json',
            success: function (result) {
                $("#user_id").val(result.userid);
                $("#requesttypeid").val(result.requesttypeid);
                $("#username").val(result.username);
                $("#name").val(result.name);
                $('#phonenumber').val(result.phonenumber);
                $('#address').val(result.address);
                $("#request_type").val(result.requesttypename)
            }
        });
    });
});

$(document).ready(function () {
    $('.deleteMDTabungan').click(function () {

        var id = $(this).data("getuserid");

        swal({
            title: "Informasi",
            text: "Apakah anda yakin akan menghapus data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: 'Masterdata/deleteMDTabungan',
                        data: { id: id },
                        dataType: 'json',
                        success: function () {

                        }
                    })
                    swal("Data berhasil dihapus", {
                        icon: "success",
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1250);
                } else {
                    swal("Batal menghapus data");
                }
            });
    })
})

$(document).ready(function () {
    $('.deleteMDSapi').click(function () {

        var id = $(this).data("getid");
        var imgproduct = $(this).data("getimgproduct");

        swal({
            title: "Informasi",
            text: "Apakah anda yakin akan menghapus data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: 'Masterdata/deleteprodukkotoransapi',
                        data: {
                            id: id,
                            imgproduct: imgproduct
                        },
                        dataType: 'json',
                        success: function () {

                        }
                    })
                    swal("Data berhasil dihapus", {
                        icon: "success",
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1250);
                } else {
                    swal("Batal menghapus data");
                }
            });
    })
})

$(document).ready(function () {
    $('.deleteDataBarang').click(function () {

        var id = $(this).data("getid");

        swal({
            title: "Informasi",
            text: "Apakah anda yakin akan menghapus data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: 'DataBarang/deletedatabarang',
                        data: { id: id },
                        dataType: 'json',
                        success: function () {

                        }
                    })
                    swal("Data berhasil dihapus", {
                        icon: "success",
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1250);
                } else {
                    swal("Batal menghapus data");
                }
            });
    })
})

$(document).ready(function () {
    $('.deleteDataTabungan').click(function () {

        var id = $(this).data("getid");

        swal({
            title: "Informasi",
            text: "Apakah anda yakin akan menghapus data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: 'DataBarang/deletedatatabungan',
                        data: { id: id },
                        dataType: 'json',
                        success: function () {

                        }
                    })
                    swal("Data berhasil dihapus", {
                        icon: "success",
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1250);
                } else {
                    swal("Batal menghapus data");
                }
            });
    })
})

$(document).ready(function () {
    $('.logout').click(function () {

        swal({
            title: "Informasi",
            text: "Keluar dari aplikasi?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'post',
                        url: 'Auth/logout',
                    })
                    swal("Berhasil keluar dari aplikasi", {
                        icon: "success",
                    });
                    setTimeout(() => {
                        window.location.href = 'login';
                    }, 1250);
                } else {
                    swal("Batal keluar dari aplikasi");
                }
            });
    })
})

$(document).ready(function () {
    $('.view_data').click(function () {
        var product_id = $(this).data("getid");
        var product_code = $(this).data("getproductcode");
        var product_name = $(this).data("getproductname");
        var categoryid = $(this).data("getcategoryid");
        var unitid = $(this).data("getunitid");
        var price = $(this).data("getprice");
        var producttypeid = $(this).data("getproducttypeid");
        var amountofgoods = $(this).data("getamountofgoods");
        var itemstatus = $(this).data("getissel");
        var imgproduct = $(this).data("getimgproduct");
        var productinformation = $(this).data("getproductinformation");
        $("#uptproductid").val(product_id);
        $("#uptproductcode").val(product_code);
        $("#uptproductname").val(product_name);
        $("#uptprice").val(price);
        $("#uptamountofgoods").val(amountofgoods);
        $("#uptcategoryproduct").val(categoryid);
        $("#uptunitofgoods").val(unitid);
        $("#uptproducttype").val(producttypeid);
        $("#uptitemstatus").val(itemstatus);
        $("#imgproductold").val(imgproduct);
        $("#uptproductinformation").val(productinformation);
    });
});

$(document).ready(function () {
    $('.view_data_mdtabungan').click(function () {
        var user_id = $(this).data("getid");
        var username = $(this).data("getusername");
        var name = $(this).data("getname");
        var amountofsavings = $(this).data("getamountofsavings");
        var phonenumber = $(this).data("phonenumber");
        var address = $(this).data("address");
        var isactive = $(this).data("getisactive");
        $("#uptuserid").val(user_id);
        $("#uptusername").val(username);
        $("#uptname").val(name);
        $("#uptamoungofsavigs").val(amountofsavings);
        $("#uptphonenumber").val(phonenumber);
        $("#uptaddress").val(address);
        $("#uptitemstatus").val(isactive);
    });
});

$(document).ready(function () {
    $('.view_data_barang').click(function () {
        var idmd = $(this).data("getidmd");
        var idbarang = $(this).data("getid");
        var productcode = $(this).data("getproductcode");
        var productname = $(this).data("getproductname");
        var amountofgoods = $(this).data("getamountofgoods");
        var oldamountofgoods = $(this).data("getoldamountofgoods");
        var amountofgoodsmd = $(this).data("getamountofgoodsmd");
        $("#uptidmd").val(idmd);
        $("#uptidbarang").val(idbarang);
        $("#updtproductcode").val(productcode);
        $("#updtproductname").val(productname);
        $("#updtamountofgoods").val(amountofgoods);
        $("#updtoldamountofgoods").val(oldamountofgoods);
        $("#updtamountofgoodsmd").val(amountofgoodsmd);
    });
});

$(document).ready(function () {
    $('.view_data_tabungan').click(function () {
        var id = $(this).data("getid");
        var idmd = $(this).data("getidmd");
        var username = $(this).data("getusername");
        var name = $(this).data("getname");
        var amountofsavings = $(this).data("getamountofsavings");
        var amountofsavingsold = $(this).data("getamountofsavingsold");
        var amountofsavingsmd = $(this).data("getamountofsavingsmd");
        var phonenumber = $(this).data("getphonenumber");
        var address = $(this).data("getaddress");
        $("#uptusername").val(username);
        $("#uptname").val(name);
        $("#uptamountofsavings").val(amountofsavings);
        $("#uptamountofsavingsmd").val(amountofsavingsmd);
        $("#uptphonenumber").val(phonenumber);
        $("#uptaddress").val(address);
        $("#uptdidtabungan").val(id);
        $("#uptidmdtabungan").val(idmd);
        $("#updtoldamountofsavings").val(amountofsavingsold);
    });
});

$(document).ready(function () {
    $('.view_data_request_barang').click(function () {
        var requestid = $(this).data("getrequestid");
        var name = $(this).data("getname");
        var phonenumber = $(this).data("getphonenumber");
        var address = $(this).data("getaddress");
        var request_type = $(this).data("getrequest_type");
        var request_date = $(this).data("getrequest_date");
        var request_status_id = $(this).data("getrequest_status_id");
        var information = $(this).data("getinformation");
        $("#uptgetrequestid").val(requestid);
        $("#uptname").val(name);
        $("#uptphonenumber").val(phonenumber);
        $("#uptaddress").val(address);
        $("#uptrequest_type").val(request_type);
        $("#uptrequest_date").val(request_date);
        $("#uptrequest_status").val(request_status_id);
        // $("#uptinfo_tambahan").val(information);
        // $("#setpicker").val();
    });
});


$(document).ready(function () {
    $("#picker").datetimepicker({
        timepicker: true,
        datepicker: true,
        format: 'Y-m-d H:i',
        weeks: true,
        step: 10,
        allowTimes: ['08:00', '08:10', '08:20', '08:30', '08:40', '08:50', '09:00', '09:10', '09:20', '09:30', '09:40', '09:50', '10:00', '10:10', '10:20', '10:30', '10:40', '10:50', '11:00', '11:10', '11:20', '11:30', '11:40', '11:50', '12:00', '13:00', '13:10', '13:20', '13:30', '13:40', '13:50', '14:00', '14:10', '14:20', '14:30', '14:40', '14:50', '15:00', '15:10', '15:20', '15:30', '15:40', '15:50', '16:00', '16:10', '16:20', '16:30'],
        disabledWeekDays: [0, 6]
    })

    $("#setpicker").on("click", function () {
        $("#picker").datetimepicker('picker');
    })
})


//insert product to cart
$(document).ready(function () {
    $(".add_cart").click(function () {
        var product_id = $(this).data("getid");
        var product_name = $(this).data("getproductname");
        var price = $(this).data("getprice");
        var quantity = $('#' + product_id).val();

        $.ajax({
            url: 'shop/addToCart',
            method: 'POST',
            data: {
                product_id: product_id,
                product_name: product_name,
                price: price,
                quantity: quantity
            },
            succes: function (data) {
                $("#detail_cart").html(data);
            }
        })
        setTimeout(() => {
            location.reload();
        }, 250);
    })
})

$(document).ready(function () {
    $(".add_cart_2").click(function () {
        var product_id = $(this).data("getid");
        var product_name = $(this).data("getproductname");
        var price = $(this).data("getprice");
        var quantity = $('#' + product_id).val();

        $.ajax({
            url: '../addToCart',
            method: 'POST',
            data: {
                product_id: product_id,
                product_name: product_name,
                price: price,
                quantity: quantity
            },
            succes: function (data) {
                $("#detail_cart").html(data);
            }
        })
        setTimeout(() => {
            location.reload();
        }, 250);

    })
})

//load shopping cart
$(document).ready(function () {
    $('#detail_cart').load('loadCart');
})

//load shopping cart
$(document).ready(function () {
    $('#detail_cart_ordering').load('loadCartOrdering');
})

$(document).on('click', '.deleteCart', function () {
    var row_id = $(this).attr('id');

    $.ajax({
        url: 'deleteCart',
        method: 'POST',
        data: {
            row_id: row_id
        },
        succes: function (data) {
            $("#detail_cart").html(data);
        }
    })
    setTimeout(() => {
        location.reload();
    }, 250);
})


















