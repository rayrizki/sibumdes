<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Registrasi</h3>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('auth/registration') ?>" method="post">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group"><label class="small mb-1" for="inputFirstName">Username</label><input class="form-control py-4" id="inputUsername" name="username" type="text" placeholder="Enter username" value="<?php echo set_value('username'); ?>" />
                                                <?php if (form_error('username')) :
                                                    echo form_error('username', '<small class="small text-danger">', '</small>');
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group"><label class="small mb-1" for="inputFirstName">Nama Lengkap</label><input class="form-control py-4" id="inputFirstName" name="fullname" type="text" placeholder="Enter full name" value="<?php echo set_value('fullname'); ?>" />
                                                <?php if (form_error('fullname')) :
                                                    echo form_error('fullname', '<small class="text-danger">', '</small>');
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group"><label class="small mb-1" for="inputPhoneNumber">Nomor Handphone
                                                </label>
                                                <input class="form-control py-4" id="inputPhoneNumber" name="phonenumber" type="text" placeholder="Enter phone number" value="<?php echo set_value('phonenumber'); ?>" />
                                                <?php if (form_error('phonenumber')) :
                                                    echo form_error('phonenumber', '<small class="small text-danger">', '</small>');
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Alamat</label><input class="form-control py-4" id="inputEmailAddress" name="address" type="text" aria-describedby="emailHelp" placeholder="Enter address" value="<?php echo set_value('address'); ?>" />
                                                <?php if (form_error('address')) :
                                                    echo form_error('address', '<small class="text-danger">', '</small>');
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" value="<?php echo set_value('password'); ?>" />
                                                <?php if (form_error('password')) :
                                                    echo form_error('password', '<small class="text-danger">', '</small>');
                                                endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Konfirmasi Password</label><input class="form-control py-4" id="inputConfirmPassword" name="confirmpassword" type="password" placeholder="Confirm password" value="<?php echo set_value('confirmpassword'); ?>" />
                                                <?php if (form_error('confirmpassword')) :
                                                    echo form_error('confirmpassword', '<small class="text-danger">', '</small>');
                                                endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" type="submit" id="registration">Buat Akun</button></div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="<?= base_url() ?>">Sudah punya akun? login</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>