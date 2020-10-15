 <!-- body the page -->
 <div id="layoutSidenav_content">
     <main>
         <div class="container-fluid">
             <input type="hidden" name="userid" id="userid" value="<?= $user_id; ?>">
             <h4 class="mt-4"><?= $title; ?></h4>
             <button type="button" class="btn btn-secondary mt-2 mb-3 addnewrequest" data-toggle="modal" data-target="#modalAddNewData">Tambah Data</button>
             <?php
                if ($this->session->flashdata('statusmessage')) { ?>
                 <script>
                     swal("Sukses", "Berhasil Menyimpan Data!", "success");
                 </script>
             <?php } else if ($this->session->flashdata('statusmessagedelete')) { ?>
                 <script>
                     alert('Data Berhasil Ditambahkan');
                 </script>
             <?php } else if ($this->session->flashdata('statusmessageupdate')) { ?>
                 <script>
                     swal("Sukses", "Berhasil Hapus Data!", "success");
                 </script>
             <?php } ?>
             <div class="card mb-4">
                 <div class="card-header"><i class="fas fa-table mr-1"></i><?= $title; ?></div>
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
                                    $queryGetDataRequest = "SELECT a.name, a.phone_number, a.address, b.name as                                'request_status_name', a.request_date, c.name as                               'request_type_name', a.pickup_date,
                                                                a.information 
                                                            FROM request_pickup_item a INNER JOIN request_status b
                                                                on a.request_status_id = b.id
                                                            INNER JOIN request_type c
                                                                ON a.request_type_id = c.id
                                                            WHERE a.user_id = $user_id";

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
                                             <a class="btn badge badge-pill badge-primary view_data_request_barang" name="view_data_request_barang" href="javascript:void(0);" data-toggle="modal" data-target=".modalUpdateData">
                                                 edit</a>
                                             <a class="btn badge badge-pill badge-warning deleteDataRequestBarang">delete</a>
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
     <div class="modal fade" id="modalAddNewData" tabindex="-1" role="dialog" aria-labelledby="myModalAddNewData" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <form class="MDValidation" method="post" action="<?= base_url(); ?>userrequest/addrequestjemputbarang" novalidate>
                     <div class="modal-header">
                         <h5 class="modal-title">Tambah Request Baru</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <div class="form-group">
                             <label for="name">Nama</label>
                             <input type="text" class="form-control" id="name" name="name" readonly>
                             <div class="invalid-feedback">
                                 nama tidak boleh kosong
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
                             <label for="request_type">Tipe Request</label>
                             <input type="text" class="form-control" id="request_type" name="request_type" readonly>
                             <div class="invalid-feedback">
                                 tipe request tidak boleh kosong
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="request_date">Tanggal Request</label>
                             <div class="input-group mb-2 mr-sm-2">
                                 <div class="input-group-prepend">
                                     <button type="button" id="setpicker" class="input-group-text"><i class="far fa-calendar-plus"></i></button>
                                 </div>
                                 <input type="text" class="form-control" id="picker" name="request_date" placeholder="Klik di sini untuk atur tanggal penjemputan" readonly>
                             </div>
                             <div class="invalid-feedback">
                                 tanggal request tidak boleh kosong
                             </div>
                         </div>
                     </div>
                     <input type="hidden" id="requesttypeid" name="requesttypeid">
                     <input type="hidden" id="user_id" name="userid">
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary" id="save_md_spumkm">Save Data</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>