            <!-- body the page -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-4"><?= $title; ?></h4>
                        <button type="button" class="btn btn-secondary mt-2 mb-3 addnewsavingsdata" data-toggle="modal" data-target=".modalAddNewData">Tambah Data</button>
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
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Tabungan</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>Jumlah Tabungan</th>
                                                <th>Nomor Handphone</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Simpan Tabungan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>Jumlah Tambah Tabungan</th>
                                                <th>Nomor Handphone</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Simpan Tabungan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $queryGetDataTabungan = "SELECT a.id, b.id as 'id_md', c.username, a.name, a.amount_of_savings, b.amount_of_savings as 'amount_of_savings_md', c.phone_number, c.address, a.savings_date
                                            FROM savings_data a INNER JOIN md_savings b
                                            ON a.md_savings_id = b.id
                                            INNER JOIN x_users c 
                                            ON b.user_id = c.id";

                                            $getDataTabungan = $this->db->query($queryGetDataTabungan)->result_array();

                                            foreach ($getDataTabungan as $datatabungan) : ?>
                                                <tr>
                                                    <td><?= ($datatabungan['username']); ?></td>
                                                    <td><?= ($datatabungan['name']); ?></td>
                                                    <td><?= ($datatabungan['amount_of_savings']); ?></td>
                                                    <td><?= ($datatabungan['phone_number']); ?></td>
                                                    <td><?= ($datatabungan['address']); ?></td>
                                                    <td><?= ($datatabungan['savings_date']); ?></td>
                                                    <td>
                                                        <a class="btn badge badge-pill badge-primary view_data_tabungan" name="view_data_tabungan" href="javascript:void(0);" data-toggle="modal" data-target=".modalUpdateData" data-getid="<?= $datatabungan['id'] ?>" data-getidmd="<?= $datatabungan['id_md'] ?>" data-getusername="<?= $datatabungan['username'] ?>" data-getname="<?= $datatabungan['name'] ?>" data-getamountofsavings="<?= $datatabungan['amount_of_savings']; ?>" data-getamountofsavingsold="<?= $datatabungan['amount_of_savings']; ?>" data-getamountofsavingsmd="<?= $datatabungan['amount_of_savings_md'] ?>" data-getphonenumber="<?= $datatabungan['phone_number'] ?>" data-getaddress="<?= $datatabungan['address'] ?>">
                                                            edit</a>
                                                        <a class="btn badge badge-pill badge-warning deleteDataTabungan" data-getid="<?= $datatabungan['id'] ?>">delete</a>
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
                            <form class="MDValidation" method="post" action="<?= base_url(); ?>databarang/updatedatatabungan" novalidate>
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="uptusername" name="name" readonly>
                                        <div class="invalid-feedback">
                                            username tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="uptname" name="name" readonly>
                                        <div class="invalid-feedback">
                                            nama tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">No. Handphone</label>
                                        <input type="text" class="form-control" id="uptphonenumber" name="phonenumber" readonly>
                                        <div class="invalid-feedback">
                                            no. handphone tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Alamat</label>
                                        <input type="text" class="form-control" id="uptaddress" name="address" readonly>
                                        <div class="invalid-feedback">
                                            alamat tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Jumlah Tabungan</label>
                                        <input type="number" class="form-control" id="uptamountofsavings" name="jumlahtabungan">
                                        <div class="invalid-feedback">
                                            jumlah tabungan tidak boleh kosong
                                        </div>
                                    </div>
                                    <input type="hidden" name="idtabungan" id="uptdidtabungan">
                                    <input type="hidden" name="idmdtabungan" id="uptidmdtabungan">
                                    <input type="hidden" name="jumlahtabunganlama" id="updtoldamountofsavings">
                                    <input type="hidden" name="jumlahtabunganmd" id="uptamountofsavingsmd">
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
                            <form class="MDValidation" method="post" action="<?= base_url(); ?>databarang/adddatatabungan" novalidate>
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    $queryGetUsername = "SELECT a.id as 'user_id', a.username
                                                            FROM x_users a INNER JOIN md_savings b
                                                            ON a.id = b.user_id
                                                            WHERE b.is_active = 1";
                                    $getUsername = $this->db->query($queryGetUsername)->result_array();

                                    ?>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <select class="form-control" id="user" name="username">
                                            <?php foreach ($getUsername as $username) :
                                            ?>
                                                <option value="<?= $username['user_id']; ?>"><?= strtoupper($username['username']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" readonly>
                                        <div class="invalid-feedback">
                                            nama produk tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">No. Handphone</label>
                                        <input type="text" class="form-control" id="phonenumber" name="phonenumber" readonly>
                                        <div class="invalid-feedback">
                                            no. handphone produk tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address" readonly>
                                        <div class="invalid-feedback">
                                            alamat tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Jumlah Tabungan</label>
                                        <input type="number" class="form-control" id="amountofsavings" name="amountofsavings">
                                        <div class="invalid-feedback">
                                            jumlah tabungan tidak boleh kosong
                                        </div>
                                    </div>
                                    <input type="hidden" id="mdsavingsid" name="mdsavingsid">
                                    <input type="hidden" id="amountsavingsmd" name="amountsavingsmd">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="save_md_spumkm">Save Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>