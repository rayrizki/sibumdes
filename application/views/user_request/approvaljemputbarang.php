<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h4 class="mt-4"><?= $title; ?></h4>
            <?php
            if ($this->session->flashdata('statusmessagedelete')) { ?>
                <script>
                    alert('Data Berhasil Ditambahkan');
                </script>
            <?php } else if ($this->session->flashdata('statusmessageupdate')) { ?>
                <script>
                    swal("Sukses", "Berhasil Update Data!", "success");
                </script>
            <?php } ?>
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-table mr-1"></i>Approval Penjemputan Barang</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Nomor Handphone</th>
                                    <th>Alamat</th>
                                    <th>Tipe Request</th>
                                    <th>Tanggal Request</th>
                                    <th>Status Request</th>
                                    <th>Tanggal Penjemputan Barang</th>
                                    <th>Keterangan Approval</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Nomor Handphone</th>
                                    <th>Alamat</th>
                                    <th>Tipe Request</th>
                                    <th>Tanggal Request</th>
                                    <th>Status Request</th>
                                    <th>Tanggal Penjemputan Barang</th>
                                    <th>Keterangan Approval</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $queryGetDataRequest = "SELECT a.id, a.name, a.phone_number, a.address, b.id as                                'request_status_id', b.name as 'request_status_name',
                                                        a.request_date, a.pickup_date,  
                                                        c.name as 'request_type_name', a.information 
                                                            FROM request_pickup_item a INNER JOIN request_status b
                                                                on a.request_status_id = b.id
                                                            INNER JOIN request_type c
                                                                ON a.request_type_id = c.id";

                                $getDataRequest = $this->db->query($queryGetDataRequest)->result_array();

                                foreach ($getDataRequest as $DataRequest) : ?>
                                    <tr>
                                        <td><?= $DataRequest['name'] ?></td>
                                        <td><?= $DataRequest['phone_number'] ?></td>
                                        <td><?= $DataRequest['address'] ?></td>
                                        <td><?= $DataRequest['request_type_name'] ?></td>
                                        <td><?= $DataRequest['request_date'] ?></td>
                                        <td><?= $DataRequest['request_status_name'] ?></td>
                                        <td><?= $DataRequest['pickup_date'] ?></td>
                                        <td><?= $DataRequest['information'] ?></td>
                                        <td>
                                            <a class="btn badge badge-pill badge-primary view_data_request_barang" name="view_data_request_barang" href="javascript:void(0);" data-toggle="modal" data-target=".modalUpdateData" data-getrequestid="<?= $DataRequest['id'] ?>" data-getname="<?= $DataRequest['name'] ?>" data-getphonenumber="<?= $DataRequest['phone_number'] ?>" data-getaddress="<?= $DataRequest['address'] ?>" data-getrequest_type="<?= $DataRequest['request_type_name'] ?>" data-getrequest_date="<?= $DataRequest['request_date'] ?>" data-getrequest_status_id="<?= $DataRequest['request_status_id'] ?>" data-getinformation="<?= $DataRequest['information'] ?>">
                                                Approval</a>
                                            <!-- <a class="btn badge badge-pill badge-warning deleteDataRequestBarang">delete</a> -->
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
                <form class="MDValidation" method="post" action="<?= base_url(); ?>userrequest/updateapprovalpenjemputanbarang" novalidate>
                    <div class="modal-header">
                        <h5 class="modal-title">Approval Penjemputan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="uptname" name="name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">No. Handphone</label>
                            <input type="text" class="form-control" id="uptphonenumber" name="phonenumber" readonly>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" class="form-control" id="uptaddress" name="address" readonly>
                        </div>
                        <div class="form-group">
                            <label for="request_type">Tipe Request</label>
                            <input type="text" class="form-control" id="uptrequest_type" name="request_type" readonly>
                        </div>
                        <div class="form-group">
                            <label for="request_date">Tanggal Request</label>
                            <input type="text" class="form-control" id="uptrequest_date" name="request_date" readonly>
                        </div>
                        <?php
                        $querycrequeststatus = "SELECT id, name
                                                    FROM request_status";

                        $requeststatusname = $this->db->query($querycrequeststatus)->result_array();
                        ?>
                        <div class="form-group">
                            <label for="request_status">Request Status</label>
                            <select class="form-control" id="uptrequest_status" name="request_status_id">
                                <?php foreach ($requeststatusname as $requeststatus) : ?>
                                    <option value="<?= $requeststatus['id'] ?>"><?= $requeststatus['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="info_tambahan">Informasi Tambahan</label>
                            <input type="text" class="form-control" id="uptinfo_tambahan" name="info_tambahan">
                        </div>
                        <div class="form-group">
                            <label for="approval_date">Tanggal Penjemputan Barang</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <button type="button" id="setpicker" class="input-group-text"><i class="far fa-calendar-plus"></i></button>
                                </div>
                                <input type="text" class="form-control" id="picker" name="approval_date" placeholder="Klik di sini untuk atur tanggal approval" readonly>
                            </div>
                            <div class="invalid-feedback">
                                tanggal request tidak boleh kosong
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="uptgetrequestid" name="requestid">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="save_md_spumkm">Approval</button>
                    </div>
                </form>
            </div>
        </div>
    </div>