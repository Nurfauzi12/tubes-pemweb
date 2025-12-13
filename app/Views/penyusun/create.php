<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Master Data</a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="<?= base_url('master/penyusun') ?>">Penyusun</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tambah</li>
          </ol>
          <h3 class="font-weight-bolder text-white mb-0">Tambah Data Penyusun</h3>
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
                  <h5>Form Tambah Data Penyusun</h5>
                  <p class="text-sm mb-0">Lengkapi form di bawah ini untuk menambah data penyusun</p>
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

              <form action="<?= base_url('master/penyusun/new') ?>" method="post" id="formPenyusun">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group mb-4">
                      <label for="pengembangan_rps" class="form-control-label">
                        Pengembangan RPS <span class="text-danger">*</span>
                      </label>
                      <input type="text" 
                             class="form-control <?= isset($validation) && $validation->hasError('pengembangan_rps') ? 'is-invalid' : '' ?>" 
                             id="pengembangan_rps" 
                             name="pengembangan_rps" 
                             placeholder="Masukkan nama pengembang RPS" 
                             value="<?= old('pengembangan_rps') ?>"
                             required>
                      <?php if (isset($validation) && $validation->hasError('pengembangan_rps')): ?>
                        <div class="invalid-feedback">
                          <?= $validation->getError('pengembangan_rps') ?>
                        </div>
                      <?php endif; ?>
                      <small class="form-text text-muted">
                        <i class="fas fa-info-circle me-1"></i>Nama dosen atau tim yang mengembangkan RPS
                      </small>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="koordinator_rumpun" class="form-control-label">
                        Koordinator Rumpun <span class="text-danger">*</span>
                      </label>
                      <input type="text" 
                             class="form-control <?= isset($validation) && $validation->hasError('koordinator_rumpun') ? 'is-invalid' : '' ?>" 
                             id="koordinator_rumpun" 
                             name="koordinator_rumpun" 
                             placeholder="Masukkan nama koordinator rumpun" 
                             value="<?= old('koordinator_rumpun') ?>"
                             required>
                      <?php if (isset($validation) && $validation->hasError('koordinator_rumpun')): ?>
                        <div class="invalid-feedback">
                          <?= $validation->getError('koordinator_rumpun') ?>
                        </div>
                      <?php endif; ?>
                      <small class="form-text text-muted">
                        <i class="fas fa-info-circle me-1"></i>Nama koordinator rumpun mata kuliah
                      </small>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="ka_prodi" class="form-control-label">
                        Kepala Program Studi <span class="text-danger">*</span>
                      </label>
                      <input type="text" 
                             class="form-control <?= isset($validation) && $validation->hasError('ka_prodi') ? 'is-invalid' : '' ?>" 
                             id="ka_prodi" 
                             name="ka_prodi" 
                             placeholder="Masukkan nama kepala program studi" 
                             value="<?= old('ka_prodi') ?>"
                             required>
                      <?php if (isset($validation) && $validation->hasError('ka_prodi')): ?>
                        <div class="invalid-feedback">
                          <?= $validation->getError('ka_prodi') ?>
                        </div>
                      <?php endif; ?>
                      <small class="form-text text-muted">
                        <i class="fas fa-info-circle me-1"></i>Nama kepala program studi yang mengesahkan
                      </small>
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
                          <p class="text-sm mb-0">Pastikan semua data yang dimasukkan sudah benar. Tanda (<span class="text-danger">*</span>) menandakan field yang wajib diisi.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-12">
                    <div class="d-flex justify-content-end gap-2">
                      <a href="<?= base_url('master/penyusun') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                      </a>
                      <button type="reset" class="btn btn-outline-warning">
                        <i class="fas fa-redo me-2"></i>Reset
                      </button>
                      <button type="submit" class="btn bg-gradient-primary">
                        <i class="fas fa-save me-2"></i>Simpan Data
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
    document.getElementById('formPenyusun').addEventListener('submit', function(e) {
      const pengembangan = document.getElementById('pengembangan_rps').value.trim();
      const koordinator = document.getElementById('koordinator_rumpun').value.trim();
      const kaProdi = document.getElementById('ka_prodi').value.trim();

      if (!pengembangan || !koordinator || !kaProdi) {
        e.preventDefault();
        alert('Semua field wajib diisi!');
        return false;
      }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      });
    }, 5000);
  </script>
</body>

<?= $this->endSection() ?>
