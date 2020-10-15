            <!-- body the page -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-4"><?= $title; ?></h4>
                        <button type="button" class="btn btn-secondary mt-2 mb-3 addnewdatabarang" data-toggle="modal" data-target=".modalAddNewData">Tambah Data</button>
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
                                swal("Sukses", "Berhasil Update Data!", "success");
                            </script>
                        <?php } ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Barang Produk Kotoran Sapi dan UMKM</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah Barang</th>
                                                <th>Tanggal Input</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah Barang</th>
                                                <th>Tanggal Input</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $queryGetData = "SELECT a.id as 'md_id', b.id, a.product_code, a.product_name, a.amount_of_goods as 'amount_of_goods_md', b.amount_of_goods, b.input_date
                                            FROM md_product a INNER JOIN product_inventory b
                                            on a.id = b.product_id;";

                                            $getData = $this->db->query($queryGetData)->result_array();

                                            foreach ($getData as $data) : ?>
                                                <tr>
                                                    <td><?= $data['product_code']; ?></td>
                                                    <td><?= $data['product_name']; ?></td>
                                                    <td><?= $data['amount_of_goods']; ?></td>
                                                    <td><?= $data['input_date'] ?></td>
                                                    <td>
                                                        <a class="btn badge badge-pill badge-primary view_data_barang" name="view_data_barang" href="javascript:void(0);" data-toggle="modal" data-target=".modalUpdateData" data-getidmd="<?= $data['md_id'] ?>" data-getid="<?= $data['id'] ?>" data-getproductcode="<?= $data['product_code'] ?>" data-getproductname="<?= $data['product_name'] ?>" data-getoldamountofgoods="<?= $data['amount_of_goods']; ?>" data-getamountofgoods="<?= $data['amount_of_goods']; ?>" data-getamountofgoodsmd="<?= $data['amount_of_goods_md']; ?>">
                                                            edit</a>
                                                        <a class="btn badge badge-pill badge-warning deleteDataBarang" data-getid="<?= $data['id'] ?>">delete</a>
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

                <!-- Modal Update Data-->
                <div class="modal fade modalUpdateData" tabindex="-1" role="dialog" aria-labelledby="myModalUpdateData" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="MDValidation" method="post" action="<?= base_url(); ?>databarang/updatedatabarang" novalidate>
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>                                
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="productcode">Kode Produk</label>
                                            <input type="text" class="form-control" id="updtproductcode" name="product_id" readonly>
                                            <div class="invalid-feedback">
                                                nama produk tidak boleh kosong
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="productname">Nama Produk</label>
                                            <input type="text" class="form-control" id="updtproductname" name="productname" readonly>
                                            <div class="invalid-feedback">
                                                nama produk tidak boleh kosong
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlahbarang">Jumlah Barang</label>
                                            <input type="number" class="form-control" id="updtamountofgoods" name="newjumlahbarang" required>
                                            <div class="invalid-feedback">
                                                jumlah barang tidak boleh kosong
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="idbarang" id="uptidbarang">
                                    <input type="hidden" name="idmd" id="uptidmd">
                                    <input type="hidden" name="jumlahbarang" id="updtoldamountofgoods">
                                    <input type="hidden" name="jumlahbarangmd" id="updtamountofgoodsmd">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="save_md_spumkm">Ubah Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Insert Data-->
                <div class="modal fade modalAddNewData" tabindex="-1" role="dialog" aria-labelledby="myModalAddNewData" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="MDValidation" method="post" action="<?= base_url(); ?>databarang/adddatabarang" novalidate>
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                                $querycmdprodoct = "SELECT id, product_code, amount_of_goods
                                                        FROM md_product
                                                        WHERE is_sell = 1";

                                $mdproduct = $this->db->query($querycmdprodoct)->result_array();
                                ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="productcode">Kode Produk</label>
                                        <select class="form-control" id="productcode" name="product_id">
                                            <?php foreach ($mdproduct as $product) :

                                            ?>
                                                <option value="<?= $product['id']; ?>"><?= $product['product_code']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="productname">Nama Produk</label>
                                        <input type="text" class="form-control" id="productname" name="productname" value="<?= set_value('productname'); ?>" readonly>
                                        <div class="invalid-feedback">
                                            nama produk tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlahbarang">Jumlah Barang</label>
                                        <input type="number" class="form-control" id="jumlahbarang" name="jumlahbarang" value="<?= set_value('jumlahbarang'); ?>" required>
                                        <div class="invalid-feedback">
                                            jumlah barang tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="jumlahbarangmd" name="jumlahbarangmd" required>
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="save_md_spumkm">Save Data</button>
                                    </div>                                
                            </form>
                        </div>
                    </div>
                </div>