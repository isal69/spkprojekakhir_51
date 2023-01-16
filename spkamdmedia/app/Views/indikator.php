<?php
$db = db_connect();
?>
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
                        <h1>Data Indikator</h1>            
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
                                                        <th>Indikator</th>
                                                        <th>Kriteria</th>
                                                        <th>Nilai (%)</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($data as $d) {
                                                        $kriteria = $db->query("select kriteria from kriteria where idkriteria = '".$d['idkriteria']."'")->getResultArray()[0]['kriteria'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $d['indikator'] ?></td>
                                                            <td><?php echo $kriteria ?></td>
                                                            <td><?php echo $d['nilai'] ?></td>
                                                            <td><button data-toggle="modal" data-target="#detail<?php echo $d['idindikator'] ?>" class="btn btn-warning btn-sm">Edit Data</button></td>
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
            <form method="post" action="<?php echo base_url('indikator/simpan') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Indikator</label>
                        <input type="text" class="form-control form-control-sm" name="indikator" placeholder="Nama Indikator" required>
                    </div>
                    <div class="form-group">
                        <label>Kriteria</label>
                        <select class="form-control form-control-sm" name="idkriteria" required>
                            <?php
                            foreach ($daftarkriteria as $k) {
                                if($k['jenis'] == 'indikator'){
                                    ?>
                                    <option value="<?php echo $k['idkriteria'] ?>"><?php echo $k['kriteria'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <input type="text" class="form-control form-control-sm" name="nilai" placeholder="Nilai Indikator" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="detail<?php echo $d['idindikator'] ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Detail Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?php echo base_url('indikator/ubah') ?>">
                    <input type="hidden" name="id" value="<?php echo $d['idindikator'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Indikator</label>
                            <input type="text" class="form-control form-control-sm" name="indikator" placeholder="Nama Indikator" value="<?php echo $d['indikator'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Kriteria</label>
                            <select class="form-control form-control-sm" name="idkriteria" required>
                                <?php foreach ($daftarkriteria as $k) {?>
                                    <option value="<?php echo $k['idkriteria'] ?>" <?php if($d['idkriteria'] == $k['idkriteria']){echo "selected";} ?>><?php echo $k['kriteria'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="text" class="form-control form-control-sm" name="nilai" placeholder="Nomor Nilai" required onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $d['nilai'] ?>">
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