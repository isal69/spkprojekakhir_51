<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo view('bagianhead') ?>
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <?php echo view('bagiannavigasi') ?>
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Data Karyawan</h1>            
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <form method="post" action="<?php echo base_url('ubahprofile') ?>">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control form-control-sm" name="username" placeholder="Username Log In" required value="<?php echo $data['username'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" class="form-control form-control-sm" name="password" placeholder="Password Log In (kosongkan jika tidak diubah)">
                                            </div>
                                        </div>
                                        <div class="card-footer bg-whitesmoke br">
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php echo view('bagianfooter') ?>
        </div>
    </div>
    <?php echo view('bagianscript') ?>
</body>
</html>