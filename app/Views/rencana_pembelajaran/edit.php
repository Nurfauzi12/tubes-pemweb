<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Rencana Pembelajaran</li>
          </ol>
          <h3 class="font-weight-bolder text-white mb-0">Edit Rencana Pembelajaran</h3>
        </nav>
      </div>
    </nav>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-0">
            <div class="card-header pb-0">
                <h5>Form Edit Rencana Pembelajaran</h5>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="" method="post" id="text-editor">
                        <input type="hidden" name="id" value="<?= $rencana['id'] ?>" />
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="id_penyusun">ID Penyusun</label>
                                <select name="id_penyusun" class="form-control" required>
                                    <option value="">Pilih Penyusun</option>
                                    <?php foreach ($penyusun as $p): ?>
                                        <option value="<?= $p['id'] ?>" <?= ($p['id'] == $rencana['id_penyusun']) ? 'selected' : '' ?>><?= $p['pengembangan_rps'] ?> - <?= $p['koordinator_rumpun'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="id_matakuliah">ID Mata Kuliah</label>
                                <select name="id_matakuliah" class="form-control" required>
                                    <option value="">Pilih Mata Kuliah</option>
                                    <?php foreach ($matakuliah as $m): ?>
                                        <option value="<?= $m['id'] ?>" <?= ($m['id'] == $rencana['id_matakuliah']) ? 'selected' : '' ?>><?= $m['kode'] ?> - <?= $m['matakuliah'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="minggu_ke">Minggu Ke</label>
                            <input type="text" name="minggu_ke" class="form-control" placeholder="Minggu Ke" value="<?= $rencana['minggu_ke'] ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="sub_cpmk">Sub CPMK</label>
                            <input type="text" name="sub_cpmk" class="form-control" placeholder="Sub CPMK" value="<?= $rencana['sub_cpmk'] ?>" required>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="penilaian_indikator">Penilaian Indikator</label>
                                <input type="text" name="penilaian_indikator" class="form-control" placeholder="Penilaian Indikator" value="<?= $rencana['penilaian_indikator'] ?>" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="penilaian_teknik">Penilaian Teknik</label>
                                <input type="text" name="penilaian_teknik" class="form-control" placeholder="Penilaian Teknik" value="<?= $rencana['penilaian_teknik'] ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="bentuk_pembelajaran">Bentuk Pembelajaran</label>
                            <input type="text" name="bentuk_pembelajaran" class="form-control" placeholder="Bentuk Pembelajaran" value="<?= $rencana['bentuk_pembelajaran'] ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="materi">Materi</label>
                            <textarea name="materi" class="form-control" placeholder="Materi" rows="3" required><?= $rencana['materi'] ?></textarea>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="bobot_penilaian">Bobot Penilaian</label>
                                <input type="text" name="bobot_penilaian" class="form-control" placeholder="Bobot Penilaian" value="<?= $rencana['bobot_penilaian'] ?>" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="catatan">Catatan</label>
                                <input type="text" name="catatan" class="form-control" placeholder="Catatan" value="<?= $rencana['catatan'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="status" value="simpan" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('table/rencana-pembelajaran') ?>" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>

<body class="g-sidenav-show bg-primary">
  <div class="min-height-300 bg-gray-100 position-absolute w-100"></div>
</body>

<?= $this->endSection() ?>