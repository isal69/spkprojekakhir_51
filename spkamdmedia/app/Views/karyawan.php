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
                                    <div class="card-header">
                                        <button data-toggle="modal" data-target="#tambah" class="btn btn-primary">Tambah Data Baru</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Jekel</th>
                                                        <th>Alamat</th>
                                                        <th>Telepon</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data as $d) {?>
                                                        <tr>
                                                            <td><?php echo $d['nama'] ?></td>
                                                            <td><?php echo $d['jekel'] ?></td>
                                                            <td><?php echo $d['alamat'] ?></td>
                                                            <td><?php echo $d['telepon'] ?></td>
                                                            <td><button data-toggle="modal" data-target="#detail<?php echo $d['idkaryawan'] ?>" class="btn btn-warning btn-sm">Edit Data</button></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo base_url('karyawan/simpan') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control form-control-sm" name="nama" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control form-control-sm" name="jekel" required>
                            <option>Wanita</option>
                            <option>Pria</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control form-control-sm" name="telepon" placeholder="Nomor Telepon" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control form-control-sm" name="alamat" placeholder="Alamat Lengkap" style="resize: none;" required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php foreach ($data as $d) {?>
    <div class="modal fade" tabindex="-1" role="dialog" id="detail<?php echo $d['idkaryawan'] ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo base_url('karyawan/ubah') ?>">
                    <input type="hidden" name="id" value="<?php echo $d['idkaryawan'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control form-control-sm" name="nama" placeholder="Nama Lengkap" required value="<?php echo $d['nama'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control form-control-sm" name="jekel" required>
                                <option <?php if($d['jekel'] == 'Wanita'){echo "selected";} ?>>Wanita</option>
                                <option <?php if($d['jekel'] == 'Pria'){echo "selected";} ?>>Pria</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" class="form-control form-control-sm" name="telepon" placeholder="Nomor Telepon" required onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $d['telepon'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control form-control-sm" name="alamat" placeholder="Alamat Lengkap" style="resize: none;" required><?php echo $d['alamat'] ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
</html>