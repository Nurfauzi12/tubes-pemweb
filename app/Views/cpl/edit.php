<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
              <a class="opacity-5 text-white" href="<?= base_url('table/cpl') ?>">Table</a>
            </li>
            <li class="breadcrumb-item text-sm">
              <a class="opacity-5 text-white" href="<?= base_url('table/cpl') ?>">CPL</a>
            </li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit</li>
          </ol>
          <h3 class="font-weight-bolder text-white mb-0">Edit CPL</h3>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <h5 class="mb-0">Edit Data CPL</h5>
              </div>

              <!-- Flash Messages -->
              <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                  <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                  <span class="alert-text"><?= session()->getFlashdata('error') ?></span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>

              <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                  <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                  <div class="alert-text">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                      <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>
            </div>

            <div class="card-body">
              <!-- Info Alert -->
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-bell-55"></i></span>
                <span class="alert-text">
                  <strong>ID CPL:</strong> <?= esc($cpl['id']) ?>
                </span>
              </div>

              <!-- Warning Alert -->
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
                <span class="alert-text">
                  Perubahan data CPL akan mempengaruhi relasi dengan korelasi CPL-CPMK dan data terkait lainnya.
                </span>
              </div>

              <form action="<?= base_url('table/cpl/' . $cpl['id'] . '/edit') ?>" method="post" id="editForm">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="cpl_prodi" class="form-control-label">
                        CPL Prodi <span class="text-danger">*</span>
                      </label>
                      <textarea
                        class="form-control <?= (session('errors.cpl_prodi')) ? 'is-invalid' : '' ?>"
                        name="cpl_prodi"
                        id="cpl_prodi"
                        rows="4"
                        placeholder="Masukkan capaian pembelajaran lulusan program studi"
                        required
                        maxlength="255"><?= old('cpl_prodi', esc($cpl['cpl_prodi'])) ?></textarea>
                      <?php if (session('errors.cpl_prodi')): ?>
                        <div class="invalid-feedback">
                          <?= session('errors.cpl_prodi') ?>
                        </div>
                      <?php endif; ?>
                      <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Maksimal 255 karakter
                      </small>
                    </div>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id_penyusun" class="form-control-label">
                        Penyusun <span class="text-danger">*</span>
                      </label>
                      <select
                        name="id_penyusun"
                        id="id_penyusun"
                        class="form-control <?= (session('errors.id_penyusun')) ? 'is-invalid' : '' ?>"
                        required>
                        <option value="">Pilih Penyusun</option>
                        <?php foreach ($penyusunList as $p): ?>
                          <option value="<?= esc($p['id']) ?>"
                            <?= (old('id_penyusun', $cpl['id_penyusun']) == $p['id']) ? 'selected' : '' ?>>
                            <?= esc($p['pengembangan_rps']) ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                      <?php if (session('errors.id_penyusun')): ?>
                        <div class="invalid-feedback">
                          <?= session('errors.id_penyusun') ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id_matakuliah" class="form-control-label">
                        Mata Kuliah <span class="text-danger">*</span>
                      </label>
                      <select
                        name="id_matakuliah"
                        id="id_matakuliah"
                        class="form-control <?= (session('errors.id_matakuliah')) ? 'is-invalid' : '' ?>"
                        required>
                        <option value="">Pilih Mata Kuliah</option>
                        <?php foreach ($matakuliahList as $mk): ?>
                          <option value="<?= esc($mk['id']) ?>"
                            <?= (old('id_matakuliah', $cpl['id_matakuliah']) == $mk['id']) ? 'selected' : '' ?>>
                            <?= esc($mk['matakuliah']) ?> (<?= esc($mk['kode']) ?>)
                          </option>
                        <?php endforeach; ?>
                      </select>
                      <?php if (session('errors.id_matakuliah')): ?>
                        <div class="invalid-feedback">
                          <?= session('errors.id_matakuliah') ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <!-- Form Action Buttons -->
                <hr class="horizontal dark mt-4">
                <div class="d-flex justify-content-between">
                  <a href="<?= base_url('table/cpl') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                  </a>
                  <div>
                    <button type="button" class="btn btn-warning me-2" id="resetBtn">
                      <i class="fas fa-undo me-2"></i>Reset
                    </button>
                    <button type="submit" class="btn btn-success" id="submitBtn">
                      <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
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

  <!-- JavaScript for Form Validation and Reset -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById('editForm');
      const resetBtn = document.getElementById('resetBtn');
      const submitBtn = document.getElementById('submitBtn');
      const formInputs = form.querySelectorAll('input, select, textarea');

      // Store original values
      const originalValues = {};
      formInputs.forEach(input => {
        originalValues[input.name] = input.value;
      });

      // Track form changes
      let formChanged = false;
      formInputs.forEach(input => {
        input.addEventListener('change', function() {
          formChanged = true;
        });
        input.addEventListener('input', function() {
          formChanged = true;
        });
      });

      // Warn user before leaving if form has changed
      window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
          e.preventDefault();
          e.returnValue = '';
          return '';
        }
      });

      // Reset button functionality
      resetBtn.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan yang belum disimpan akan hilang.')) {
          formInputs.forEach(input => {
            input.value = originalValues[input.name];
            input.classList.remove('is-invalid');
          });
          formChanged = false;
        }
      });

      // Form submission - remove beforeunload handler
      form.addEventListener('submit', function() {
        formChanged = false;
      });

      // Character counter for textarea
      const cplProdiTextarea = document.getElementById('cpl_prodi');
      if (cplProdiTextarea) {
        const maxLength = cplProdiTextarea.getAttribute('maxlength');
        const charCountElement = document.createElement('small');
        charCountElement.className = 'text-muted float-end';
        cplProdiTextarea.parentNode.appendChild(charCountElement);

        function updateCharCount() {
          const currentLength = cplProdiTextarea.value.length;
          charCountElement.textContent = `${currentLength}/${maxLength} karakter`;

          if (currentLength >= maxLength) {
            charCountElement.classList.remove('text-muted');
            charCountElement.classList.add('text-danger');
          } else {
            charCountElement.classList.remove('text-danger');
            charCountElement.classList.add('text-muted');
          }
        }

        cplProdiTextarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial call
      }
    });
  </script>
</body>

<?= $this->endSection() ?>
