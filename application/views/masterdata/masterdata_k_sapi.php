            <!-- body the page -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-4"><?= $title; ?></h4>
                        <button type="button" class="btn btn-secondary mt-2 mb-3" data-toggle="modal" data-target=".modalAddNewData">Tambah Data</button>
                        <?php
                        if ($this->session->flashdata('statusmessage')) { ?>
                            <!-- echo $_SESSION['statusmessage']; -->
                            <script>
                                swal("Sukses", "Berhasil Menyimpan Data!", "success");
                            </script>
                        <?php } else if ($this->session->flashdata('statusmessagedelete')) { ?>
                            <!-- echo $_SESSION['statusmessagedelete']; -->
                            <script>
                                alert('Data Berhasil Ditambahkan');
                            </script>
                        <?php } else if ($this->session->flashdata('statusmessageupdate')) { ?>
                            <!--echo $_SESSION['statusmessagedelete']; -->
                            <script>
                                swal("Sukses", "Berhasil Hapus Data!", "success");
                            </script>
                        <?php } ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Produk Kotoran Sapi</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Foto Produk</th>
                                                <th>Satuan Barang</th>
                                                <th>Harga</th>
                                                <th>Tipe Produk</th>
                                                <th>Jumlah Barang</th>
                                                <th>Informasi Barang</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $queryGetMD = "SELECT A.ID, A.PRODUCT_CODE, A.PRODUCT_NAME, B.CATEGORY_ID, B.NAME as 'CATEGORY NAME', A.IMG_PRODUCT, C.UNIT_ID, C.NAME as 'UNIT NAME', A.PRICE, A.IMG_PRODUCT,D.PRODUCT_TYPE_ID, D.NAME as 'PRODUCT TYPE NAME', A.AMOUNT_OF_GOODS, A.PRODUCT_INFORMATION ,A.CREATE_DATE, A.IS_SELL        
                                            FROM MD_PRODUCT A INNER JOIN CATEGORY_PRODUCT B
                                            ON A.CATEGORY_ID = B.CATEGORY_ID
                                            INNER JOIN UNIT_OF_GOODS C
                                            ON A.UNIT_ID = C.UNIT_ID
                                            INNER JOIN PRODUCT_TYPE D
                                            ON A.PRODUCT_TYPE_ID = D.PRODUCT_TYPE_ID";

                                            $getMD = $this->db->query($queryGetMD)->result_array();

                                            foreach ($getMD as $MD) : ?>
                                                <tr>
                                                    <td><?= ($MD['PRODUCT_CODE']); ?></td>
                                                    <td><?= ($MD['PRODUCT_NAME']); ?></td>
                                                    <td><img src="<?= base_url('assets/img/upload/product/' . $MD['IMG_PRODUCT']); ?>" style="height: 100px; width: 150px"></td>
                                                    <td><?= ($MD['UNIT NAME']); ?></td>
                                                    <td><?= ($MD['PRICE']); ?></td>
                                                    <td><?= ($MD['PRODUCT TYPE NAME']); ?></td>
                                                    <td><?= ($MD['AMOUNT_OF_GOODS']); ?></td>
                                                    <td><?= ($MD['PRODUCT_INFORMATION']); ?></td>
                                                    <td><?= $MD['IS_SELL'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                                    <td>
                                                        <a class=" btn badge badge-pill badge-primary view_data" name="view_data" href="javascript:void(0);" data-toggle="modal" data-target=".modalUpdateData" data-getid="<?= $MD['ID'] ?>" data-getproductcode="<?= $MD['PRODUCT_CODE'] ?>" data-getproductname="<?= $MD['PRODUCT_NAME'] ?>" data-getcategoryid="<?= $MD['CATEGORY_ID']; ?>" data-getcategoryname="<?= $MD['CATEGORY NAME'] ?>" data-getunitid="<?= $MD['UNIT_ID'] ?>" data-getunitname="<?= $MD['UNIT NAME'] ?>" data-getprice="<?= $MD['PRICE'] ?>" data-getproducttypeid="<?= $MD['PRODUCT_TYPE_ID'] ?>" data-getproducttype="<?= $MD['PRODUCT TYPE NAME'] ?>" data-getamountofgoods="<?= $MD['AMOUNT_OF_GOODS'] ?>" data-getproductinformation="<?= $MD['PRODUCT_INFORMATION'] ?>" data-getissel="<?= $MD['IS_SELL'] ?>" data-getimgproduct="<?= $MD['IMG_PRODUCT'] ?>">
                                                            edit</a>
                                                        <a class="btn badge badge-pill badge-warning deleteMDSapi" data-getid="<?= $MD['ID'] ?>" data-getimgproduct="<?= $MD['IMG_PRODUCT'] ?>">delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Modal Insert Data-->
                <div class="modal fade modalAddNewData" tabindex="-1" role="dialog" aria-labelledby="myModalAddNewData" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <?= form_open_multipart('masterdata/addmdprodukkotoransapi', 'class="MDValidation" novalidate') ?>
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="productid">Kode Produk</label>
                                    <input type="text" class="form-control" id="productcode" name="productcode" value="<?= set_value('productcode'); ?>" required>
                                    <?php if (form_error('productcode')) :
                                        echo form_error('productcode', '<small class="small text-danger">', '</small>');
                                    endif; ?>
                                    <div class="invalid-feedback">
                                        Kode produk tidak boleh kosong
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="productname">Nama Produk</label>
                                    <input type="text" class="form-control" id="productname" name="productname" value="<?= set_value('productname'); ?>" required>
                                    <?php if (form_error('productname')) :
                                        echo form_error('productname', '<small class="small text-danger">', '</small>');
                                    endif; ?>
                                    <div class="invalid-feedback">
                                        nama produk tidak boleh kosong
                                    </div>
                                </div>
                                <?php
                                $querycategoryproduct = "SELECT *
                                                                FROM category_product
                                                                WHERE is_active = 1";

                                $categoryproducts = $this->db->query($querycategoryproduct)->result_array();
                                ?>
                                <div class="form-group">
                                    <label for="categoryproduct">Kategori Produk</label>
                                    <select class="form-control" id="categoryproduct" name="category_id">
                                        <?php foreach ($categoryproducts as $categoryproduct) :
                                        ?>
                                            <option value="<?= $categoryproduct['category_id']; ?>"><?= $categoryproduct['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php
                                $queryunitsofgoods = "SELECT *
                                                                FROM unit_of_goods
                                                                WHERE is_active = 1";

                                $unitsofgoods = $this->db->query($queryunitsofgoods)->result_array();
                                ?>
                                <div class="form-group">
                                    <label for="unitofgoods">Satuan Barang</label>
                                    <select class="form-control" id="unitofgoods" name="unit_id">
                                        <?php foreach ($unitsofgoods as $unitofgoods) : ?>
                                            <option value="<?= $unitofgoods['unit_id']; ?>"><?= $unitofgoods['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="text" class="form-control" id="price" name="price" value="<?= set_value('price'); ?>" required>
                                    <?php if (form_error('price')) :
                                        echo form_error('price', '<small class="small text-danger">', '</small>');
                                    endif; ?>
                                    <div class="invalid-feedback">
                                        harga tidak boleh kosong
                                    </div>
                                </div>
                                <?php
                                $queryproducttype = "SELECT *
                                                                FROM product_type
                                                                WHERE is_active = 1";

                                $producttypes = $this->db->query($queryproducttype)->result_array();
                                ?>
                                <div class="form-group">
                                    <label for="producttype">Tipe Produk</label>
                                    <select class="form-control" id="producttype" name="product_type_id">
                                        <?php foreach ($producttypes as $producttype) : ?>
                                            <option value="<?= $producttype['product_type_id']; ?>"><?= $producttype['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amountofgoods">Jumlah Barang</label>
                                    <input type="number" class="form-control" id="amountofgoods" name="amountofgoods" value="<?= set_value('amountofgoods'); ?>" disabled>
                                    <?php if (form_error('amountofgoods')) :
                                        echo form_error('amountofgoods', '<small class="small text-danger">', '</small>');
                                    endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="productinformation">Informasi Produk</label>
                                    <input type="text" class="form-control" id="productinformation" name="productinformation" value="<?= set_value('productinfotmation'); ?>" required>
                                    <div class="invalid-feedback">
                                        Informasi produk tidak boleh kosong
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="itemstatus" name="item_status">
                                        <option value="1">Aktif</option>
                                        <option value="2">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Upload Foto Produk</label>
                                    <input type="file" id="fotoproduk" name="foto_produk">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="save_md_spumkm">Save Data</button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>


                <!-- Modal Update Data-->
                <div class="modal fade modalUpdateData" tabindex="-1" role="dialog" aria-labelledby="myModalUpdateData" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <?= form_open_multipart('masterdata/updateprodukkotoransapi', 'class="MDValidation" novalidate') ?>
                            <input type="hidden" id="uptproductid" name="productid" value="">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="uptproductcode">Kode Produk</label>
                                    <input type="text" class="form-control" id="uptproductcode" name="productcode" value="" required>
                                    <?php if (form_error('uptproductcode')) :
                                        echo form_error('uptproductcode', '<small class="small text-danger">', '</small>');
                                    endif; ?>
                                    <div class="invalid-feedback">
                                        kode produk tidak boleh kosong
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uptproductname">Nama Produk</label>
                                    <input type="text" class="form-control" id="uptproductname" name="productname" value="<?= set_value('uptproductname'); ?>" required>
                                    <?php if (form_error('uptproductname')) :
                                        echo form_error('uptproductname', '<small class="small text-danger">', '</small>');
                                    endif; ?>
                                    <div class="invalid-feedback">
                                        nama produk tidak boleh kosong
                                    </div>
                                </div>
                                <?php
                                $querycategoryproduct = "SELECT *
                                                                FROM category_product
                                                                WHERE is_active = 1";

                                $categoryproducts = $this->db->query($querycategoryproduct)->result_array();
                                ?>
                                <div class="form-group">
                                    <label for="uptcategoryproduct">Kategori Produk</label>
                                    <select class="form-control" id="uptcategoryproduct" name="categoryproduct">
                                        <?php foreach ($categoryproducts as $categoryproduct) :
                                        ?>
                                            <option value="<?= $categoryproduct['category_id']; ?>"><?= $categoryproduct['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php
                                $queryunitsofgoods = "SELECT *
                                                                FROM unit_of_goods
                                                                WHERE is_active = 1";

                                $unitsofgoods = $this->db->query($queryunitsofgoods)->result_array();
                                ?>
                                <div class="form-group">
                                    <label for="uptunitofgoods">Satuan Barang</label>
                                    <select class="form-control" id="uptunitofgoods" name="unitofgoods">
                                        <?php foreach ($unitsofgoods as $unitofgoods) : ?>
                                            <option value="<?= $unitofgoods['unit_id']; ?>"><?= $unitofgoods['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="uptprice">Harga</label>
                                    <input type="text" class="form-control" id="uptprice" name="price" value="" required>
                                    <?php if (form_error('uptprice')) :
                                        echo form_error('uptprice', '<small class="small text-danger">', '</small>');
                                    endif; ?>
                                    <div class="invalid-feedback">
                                        harga tidak boleh kosong
                                    </div>
                                </div>
                                <?php
                                $queryproducttype = "SELECT *
                                                                FROM product_type
                                                                WHERE is_active = 1";

                                $producttypes = $this->db->query($queryproducttype)->result_array();
                                ?>
                                <div class="form-group">
                                    <label for="uptproducttype">Tipe Produk</label>
                                    <select class="form-control" id="uptproducttype" name="producttype">
                                        <?php foreach ($producttypes as $producttype) : ?>
                                            <option value="<?= $producttype['product_type_id']; ?>"><?= $producttype['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="uptamountofgoods">Jumlah Barang</label>
                                    <input type="number" class="form-control" id="uptamountofgoods" name="amountofgoods" value="<?= set_value('uptamountofgoods'); ?>" disabled>
                                    <?php if (form_error('uptamountofgoods')) :
                                        echo form_error('uptamountofgoods', '<small class="small text-danger">', '</small>');
                                    endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="productinformation">Informasi Produk</label>
                                    <input type="text" class="form-control" id="uptproductinformation" name="productinformation" value="<?= set_value('productinfotmation'); ?>" required>
                                    <div class="invalid-feedback">
                                        Informasi produk tidak boleh kosong
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uptitem_status">Status</label>
                                    <select class="form-control" id="uptitemstatus" name="itemstatus">
                                        <option value="1">Aktif</option>
                                        <option value="2">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Upload Foto Produk</label>
                                    <input type="file" id="uptfotoproduk" name="foto_produk">
                                    <input type="hidden" id="imgproductold" name="foto_produk_old">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>