<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Login</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                if ($this->session->flashdata('message')) :
                                    echo $_SESSION['message'];
                                endif; ?>
                                <form method="post" action="<?= base_url() ?>auth/index">
                                    <div class="form-group"><label class="small mb-1" for="inputUsername">Username</label><input class="form-control py-4" id="inputUsername" name="username" type="text" value="<?= set_value('username'); ?>" placeholder="Enter your username" />
                                        <?php if (form_error('username')) :
                                            echo form_error('username', '<small class="small text-danger">', '</small>');
                                        endif; ?>
                                    </div>
                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="password" type="password" value="<?= set_value('password'); ?>" placeholder="Enter password" />
                                        <?php if (form_error('password')) :
                                            echo form_error('password', '<small class="small text-danger">', '</small>');
                                        endif; ?>
                                    </div>
                                    <div class="form-group d-flex align-items-center float-right mt-0 mb-0"><button class="btn btn-primary" type="submit" id="login" name="login">Login</button></div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="<?= base_url() ?>register">Belum punya akun? Daftar sekarang!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>