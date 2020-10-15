            <!-- body the page -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-4"><?= $title; ?></h4>
                        <button type="button" class="btn btn-secondary mt-2 mb-3 addnewdata" data-toggle="modal" data-target=".modalAddNewData">Tambah Data</button>
                        <?php
                        if ($this->session->flashdata('statusmessage')) { ?>
                            <!-- echo $_SESSION['statusmessage']; -->
                            <script>
                                swal("Sukses", "Berhasil Menyimpan Data!", "success");
                            </script>
                        <?php } else if ($this->session->flashdata('statusmessagedelete')) { ?>
                            <!-- echo $_SESSION['statusmessagedelete']; -->
                            <script>
                                // alert('Data Berhasil Ditambahkan');
                            </script>
                        <?php } else if ($this->session->flashdata('statusmessageupdate')) { ?>
                            <!--echo $_SESSION['statusmessagedelete']; -->
                            <script>
                                swal("Sukses", "Berhasil Update Data!", "success");
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
                                                <th>Nama</th>
                                                <th>Jumlah Tabungan</th>
                                                <th>Nomor Handphone</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Username</th>
                                                <th>Nama</th>
                                                <th>Jumlah Tabungan</th>
                                                <th>Nomor Handphone</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $queryGetMD = "SELECT b.id, a.username, a.name, b.amount_of_savings, a.phone_number, a.address, b.create_date, b.is_active
                                                FROM x_users a INNER JOIN md_savings b
                                                on a.id = b.user_id";

                                            $getMD = $this->db->query($queryGetMD)->result_array();

                                            foreach ($getMD as $MD) : ?>
                                                <tr>
                                                    <td><?= ($MD['username']); ?></td>
                                                    <td><?= ($MD['name']); ?></td>
                                                    <td><?= ($MD['amount_of_savings']); ?></td>
                                                    <td><?= ($MD['phone_number']); ?></td>
                                                    <td><?= ($MD['address']); ?></td>
                                                    <td><?= ($MD['create_date']); ?></td>
                                                    <td><?= $MD['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                                    <td>
                                                        <a class="btn badge badge-pill badge-primary view_data_mdtabungan" name="view_data_mdtabungan" href="javascript:void(0);" data-toggle="modal" data-target=".modalUpdateData" data-getid="<?= $MD['id'] ?>" data-getusername="<?= $MD['username'] ?>" data-getname="<?= $MD['name'] ?>" data-getamountofsavings="<?= $MD['amount_of_savings']; ?>" data-phonenumber="<?= $MD['phone_number'] ?>" data-address="<?= $MD['address'] ?>" data-getcreatedate="<?= $MD['create_date'] ?>" data-getisactive="<?= $MD['is_active'] ?>"> edit</a>
                                                        <a class="btn badge badge-pill badge-warning deleteMDTabungan" data-getuserid="<?= $MD['id'] ?>">delete</a>
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
                            <form method="post" action="<?= base_url(); ?>masterdata/updatemdtabungan">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <input type="hidden" name="userid" id="uptuserid">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="uptusername" name="username" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="uptname" name="name" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="amoungofsavigs">Jumlah Tabungan</label>
                                        <input type="text" class="form-control" id="uptamoungofsavigs" name="amoungofsavigs" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="phonenumber">Nomor Handphone</label>
                                        <input type="text" class="form-control" id="uptphonenumber" name="phonenumber" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control" id="uptaddress" name="address" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="itemstatus">Status</label>
                                        <select class="form-control" id="uptitemstatus" name="itemstatus">
                                            <option value="1">Aktif</option>
                                            <option value="2">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Insert Data-->
                <div class="modal fade modalAddNewData" tabindex="-1" role="dialog" aria-labelledby="myModalAddNewData" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form method="post" action="<?= base_url(); ?>masterdata/addmdtabungan" novalidate>
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    $queryGetUsername = "SELECT id, username
                                                                FROM x_users a
                                                                WHERE NOT EXISTS (
                                                                    SELECT id FROM md_savings b 
                                                                    WHERE a.id = b.user_id
                                                                   )";

                                    $getUsername = $this->db->query($queryGetUsername)->result_array();

                                    ?>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <select class="form-control" id="username" name="username">
                                            <?php foreach ($getUsername as $username) :
                                            ?>
                                                <option value="<?= $username['id']; ?>"><?= strtoupper($username['username']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>" required readonly>
                                        <?php if (form_error('name')) :
                                            echo form_error('name', '<small class="small text-danger">', '</small>');
                                        endif; ?>
                                        <div class="invalid-feedback">
                                            nama tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amountofsavings">Jumlah Tabungan</label>
                                        <input type="text" class="form-control" id="amountofsavings" name="amountofsavings" value="<?= set_value('amountofsavings'); ?>" required readonly>
                                        <?php if (form_error('amountofsavings')) :
                                            echo form_error('amountofsavings', '<small class="small text-danger">', '</small>');
                                        endif; ?>
                                        <div class="invalid-feedback">
                                            jumlah tabungan tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phonenumber">Nomor Handphone</label>
                                        <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?= set_value('price'); ?>" required readonly>
                                        <?php if (form_error('phonenumber')) :
                                            echo form_error('phonenumber', '<small class="small text-danger">', '</small>');
                                        endif; ?>
                                        <div class="invalid-feedback">
                                            nomor handphone tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?= set_value('address'); ?>" required readonly>
                                        <?php if (form_error('address')) :
                                            echo form_error('address', '<small class="small text-danger">', '</small>');
                                        endif; ?>
                                        <div class="invalid-feedback">
                                            alamat tidak boleh kosong
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="itemstatus" name="item_status">
                                            <option value="1">Aktif</option>
                                            <option value="2">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="save_md_spumkm">Save Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>