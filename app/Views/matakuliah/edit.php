<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Master Data</a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="<?= base_url('master/matakuliah') ?>">Mata Kuliah</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit</li>
          </ol>
          <h3 class="font-weight-bolder text-white mb-0">Edit Data Mata Kuliah</h3>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5>Form Edit Data Mata Kuliah</h5>
                  <p class="text-sm mb-0">Perbarui data mata kuliah dengan mengisi form di bawah ini</p>
                </div>
              </div>
            </div>

            <div class="card-body px-4 pt-4 pb-2">
              <?php if (isset($validation)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                  <span class="alert-text"><strong>Kesalahan!</strong> Periksa kembali data yang Anda masukkan.</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>

              <form action="" method="post" id="formMatakuliah">
                <input type="hidden" name="id" value="<?= $matakuliah['id'] ?>" />

                <!-- Nama Matakuliah -->
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-4">
                    <label class="form-control-label">
                        Mata Kuliah <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                        name="matakuliah"
                        class="form-control <?= (isset($validation) && $validation->hasError('matakuliah')) ? 'is-invalid' : '' ?>"
                        value="<?= old('matakuliah', $matakuliah['matakuliah']) ?>"
                        required>

                    <div class="invalid-feedback">
                        <?= isset($validation) ? $validation->getError('matakuliah') : '' ?>
                    </div>
                    </div>
                </div>
                </div>


                <div class="row">
                    <!-- Kode -->
                    <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label class="form-control-label">
                        Kode Mata Kuliah <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            name="kode"
                            class="form-control <?= isset($validation) && $validation->hasError('kode') ? 'is-invalid' : '' ?>"
                            value="<?= old('kode', $matakuliah['kode']) ?>"
                            required>
                    </div>
                    </div>

                    <!-- Rumpun -->
                    <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label class="form-control-label">
                        Rumpun <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            name="rumpun"
                            class="form-control <?= isset($validation) && $validation->hasError('rumpun') ? 'is-invalid' : '' ?>"
                            value="<?= old('rumpun', $matakuliah['rumpun']) ?>"
                            required>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Bobot Teori -->
                    <div class="col-md-4">
                    <div class="form-group mb-4">
                        <label class="form-control-label">
                        Bobot Teori <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                            name="bobot_teori"
                            class="form-control"
                            value="<?= old('bobot_teori', $matakuliah['bobot_teori']) ?>"
                            required>
                    </div>
                    </div>

                    <!-- Bobot Praktek -->
                    <div class="col-md-4">
                    <div class="form-group mb-4">
                        <label class="form-control-label">
                        Bobot Praktek <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                            name="bobot_praktek"
                            class="form-control"
                            value="<?= old('bobot_praktek', $matakuliah['bobot_praktek']) ?>"
                            required>
                    </div>
                    </div>

                    <!-- Semester -->
                    <div class="col-md-4">
                    <div class="form-group mb-4">
                        <label class="form-control-label">
                        Semester <span class="text-danger">*</span>
                        </label>
                        <input type="number"
                            name="semester"
                            class="form-control"
                            value="<?= old('semester', $matakuliah['semester']) ?>"
                            required>
                    </div>
                    </div>
                </div>

                <!-- Tanggal -->
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label class="form-control-label">
                        Tanggal <span class="text-danger">*</span>
                        </label>
                        <input type="date"
                            name="tanggal"
                            class="form-control"
                            value="<?= old('tanggal', $matakuliah['tanggal']) ?>"
                            required>
                    </div>
                    </div>
                </div>


                <div class="row mt-4">
                  <div class="col-12">
                    <div class="alert alert-info border" role="alert">
                      <div class="d-flex">
                        <div>
                          <i class="fas fa-info-circle text-info fa-2x me-3"></i>
                        </div>
                        <div>
                          <h6 class="alert-heading mb-1">Informasi</h6>
                          <p class="text-sm mb-1"><strong>ID Mata Kuliah:</strong> <?= $matakuliah['id'] ?></p>
                          <p class="text-sm mb-0">Pastikan semua perubahan data sudah sesuai sebelum menyimpan.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-12">
                    <div class="alert alert-light border" role="alert">
                      <div class="d-flex">
                        <div>
                          <i class="fas fa-exclamation-triangle text-warning fa-2x me-3"></i>
                        </div>
                        <div>
                          <h6 class="alert-heading mb-1">Perhatian</h6>
                          <p class="text-sm mb-0">Perubahan data mata kuliah akan mempengaruhi semua data yang terkait dengan mata kuliah ini. Tanda (<span class="text-danger">*</span>) menandakan field yang wajib diisi.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-12">
                    <div class="d-flex justify-content-end gap-2">
                      <a href="<?= base_url('master/matakuliah') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                      </a>
                      <button type="reset" class="btn btn-outline-warning">
                        <i class="fas fa-redo me-2"></i>Reset
                      </button>
                      <button type="submit" class="btn bg-gradient-success">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                      </button>
                    </div>
                  </div>
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

  <script>
    // Form validation
    document.getElementById('formMatakuliah').addEventListener('submit', function(e) {
      const pengembangan = document.getElementById('pengembangan_rps').value.trim();
      const koordinator = document.getElementById('koordinator_rumpun').value.trim();
      const kaProdi = document.getElementById('ka_prodi').value.trim();

      if (!pengembangan || !koordinator || !kaProdi) {
        e.preventDefault();
        alert('Semua field wajib diisi!');
        return false;
      }
    });

    // Confirmation before leaving if form has changes
    let formChanged = false;
    const formInputs = document.querySelectorAll('#formMatakuliah input[type="text"]');
    
    formInputs.forEach(input => {
      input.addEventListener('change', function() {
        formChanged = true;
      });
    });

    window.addEventListener('beforeunload', function(e) {
      if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
      }
    });

    document.getElementById('formMatakuliah').addEventListener('submit', function() {
      formChanged = false;
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
      const alerts = document.querySelectorAll('.alert-danger, .alert-success');
      alerts.forEach(function(alert) {
        if (alert.querySelector('.btn-close')) {
          const bsAlert = new bootstrap.Alert(alert);
          bsAlert.close();
        }
      });
    }, 5000);
  </script>
</body>

<?= $this->endSection() ?>
