<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
       id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm">
            <a class="opacity-5 text-white" href="javascript:;">Master Data</a>
          </li>
          <li class="breadcrumb-item text-sm">
            <a class="opacity-5 text-white" href="<?= base_url('master/cpmk') ?>">CPMK</a>
          </li>
          <li class="breadcrumb-item text-sm text-white active">Edit</li>
        </ol>
        <h3 class="font-weight-bolder text-white mb-0">Edit CPMK</h3>
      </nav>
    </div>
  </nav>

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-0">

          <!-- Header -->
          <div class="card-header pb-0">
            <h5 class="mb-0">Form Edit CPMK</h5>
            <h6 class="text-sm text-secondary mb-0">
              Perbarui data Capaian Pembelajaran Mata Kuliah
            </h6>

            <?php if (isset($validation)): ?>
              <div class="alert alert-danger alert-dismissible fade show mt-3">
                <strong>Kesalahan!</strong> Periksa kembali data yang Anda masukkan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php endif; ?>
          </div>

          <!-- Body -->
          <div class="card-body pt-4">
            <form action="<?= base_url('master/cpmk/' . $cpmk['id'] . '/edit') ?>" method="post" id="formEditCpmk">
              <?= csrf_field() ?>

              <input type="hidden" name="id" value="<?= $cpmk['id'] ?>">

              <div class="row">
                <!-- Mata Kuliah -->
                <div class="col-md-6">
                  <div class="form-group mb-4">
                    <label class="form-control-label">
                      Mata Kuliah <span class="text-danger">*</span>
                    </label>
                    <select name="id_matakuliah" class="form-control" required>
                      <option value="">-- Pilih Mata Kuliah --</option>
                      <?php foreach ($matakuliah_list as $m): ?>
                        <option value="<?= $m['id'] ?>"
                          <?= old('id_matakuliah', $cpmk['id_matakuliah']) == $m['id'] ? 'selected' : '' ?>>
                          <?= esc($m['matakuliah']) ?> (<?= esc($m['kode']) ?>)
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <!-- Penyusun -->
                <div class="col-md-6">
                  <div class="form-group mb-4">
                    <label class="form-control-label">Penyusun</label>
                    <select name="id_penyusun" class="form-control">
                      <option value="">-- Opsional --</option>
                      <?php foreach ($penyusun_list as $p): ?>
                        <option value="<?= $p['id'] ?>"
                          <?= old('id_penyusun', $cpmk['id_penyusun']) == $p['id'] ? 'selected' : '' ?>>
                          <?= esc($p['pengembangan_rps']) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <!-- CPMK -->
              <div class="row">
                <div class="col-12">
                  <div class="form-group mb-4">
                    <label class="form-control-label">
                      CPMK <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="cpmk"
                           class="form-control <?= isset($validation) && $validation->hasError('cpmk') ? 'is-invalid' : '' ?>"
                           value="<?= old('cpmk', $cpmk['cpmk']) ?>"
                           required>

                    <?php if (isset($validation) && $validation->hasError('cpmk')): ?>
                      <div class="invalid-feedback">
                        <?= $validation->getError('cpmk') ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <!-- Action -->
              <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="<?= base_url('master/cpmk') ?>" class="btn btn-outline-secondary">
                  Kembali
                </a>
                <button type="submit" class="btn bg-gradient-warning">
                  Update CPMK
                </button>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>

<body class="g-sidenav-show bg-primary">
  <div class="min-height-300 bg-gray-100 position-absolute w-100"></div>
</body>

<script>
  document.getElementById('formEditCpmk').addEventListener('submit', function(e) {
    const cpmk = document.querySelector('[name="cpmk"]').value.trim();
    const matkul = document.querySelector('[name="id_matakuliah"]').value;

    if (!matkul || !cpmk) {
      e.preventDefault();
      alert('Field bertanda * wajib diisi');
    }
  });
</script>

<?= $this->endSection() ?>
