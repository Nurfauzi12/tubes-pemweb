<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Tables</a></li>
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="<?= base_url('table/nilai-kompetensi') ?>">Nilai Kompetensi</a></li>
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tambah</li>
        </ol>
        <h3 class="font-weight-bolder text-white mb-0">Tambah Nilai Kompetensi</h3>
      </nav>
    </div>
  </nav>

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Form Tambah Nilai Kompetensi</h5>
            <p class="text-sm mb-0">Isi data nilai kompetensi mahasiswa</p>
          </div>
          <div class="card-body px-4 pt-4 pb-2">
            <?php if (isset($validation)): ?>
              <div class="alert alert-danger">Periksa kembali data yang dimasukkan.</div>
            <?php endif; ?>

            <form action="<?= base_url('table/nilai-kompetensi/new') ?>" method="post" id="formNilai">
              <div class="row">
                <div class="col-md-6">
                  <label>NIM</label>
                  <div class="input-group mb-3">
                    <select name="nim" class="form-control <?= isset($validation) && $validation->hasError('nim') ? 'is-invalid' : '' ?>" required>
                      <option value="">Pilih Mahasiswa</option>
                      <?php foreach ($mahasiswa ?? [] as $m): ?>
                        <option value="<?= esc($m['nim']) ?>" <?= old('nim') == $m['nim'] ? 'selected' : '' ?>><?= esc($m['nim']) ?> - <?= esc($m['nama_mahasiswa']) ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('nim')): ?>
                      <div class="invalid-feedback"><?= $validation->getError('nim') ?></div>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col-md-6">
                  <label>Rencana Pembelajaran</label>
                  <div class="input-group mb-3">
                    <select name="id_rencana_pembelajaran" class="form-control <?= isset($validation) && $validation->hasError('id_rencana_pembelajaran') ? 'is-invalid' : '' ?>" required>
                      <option value="">Pilih Rencana</option>
                      <?php foreach ($rencana ?? [] as $r): ?>
                        <option value="<?= esc($r['id']) ?>" <?= old('id_rencana_pembelajaran') == $r['id'] ? 'selected' : '' ?>><?= esc($r['minggu_ke']) ?> - <?= esc($r['materi']) ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('id_rencana_pembelajaran')): ?>
                      <div class="invalid-feedback"><?= $validation->getError('id_rencana_pembelajaran') ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <label>Nilai Kompetensi</label>
                  <div class="input-group mb-3">
                    <input type="number" name="nilai_kompetensi" min="0" max="100" class="form-control <?= isset($validation) && $validation->hasError('nilai_kompetensi') ? 'is-invalid' : '' ?>" value="<?= old('nilai_kompetensi') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('nilai_kompetensi')): ?>
                      <div class="invalid-feedback"><?= $validation->getError('nilai_kompetensi') ?></div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Status</label>
                  <div class="input-group mb-3">
                    <select name="status" class="form-control <?= isset($validation) && $validation->hasError('status') ? 'is-invalid' : '' ?>" required>
                      <option value="">Pilih Status</option>
                      <option value="lulus" <?= old('status')=='lulus' ? 'selected' : '' ?>>Lulus</option>
                      <option value="belum" <?= old('status')=='belum' ? 'selected' : '' ?>>Belum</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('status')): ?>
                      <div class="invalid-feedback"><?= $validation->getError('status') ?></div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Keterangan</label>
                  <div class="input-group mb-3">
                    <input type="text" name="keterangan" class="form-control" value="<?= old('keterangan') ?>">
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="<?= base_url('table/nilai-kompetensi') ?>" class="btn btn-outline-secondary">Kembali</a>
                <button type="submit" class="btn bg-gradient-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?= $this->endSection() ?>
