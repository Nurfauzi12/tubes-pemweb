<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm">
            <a class="opacity-5 text-white" href="javascript:;">Master Data</a>
          </li>
          <li class="breadcrumb-item text-sm">
            <a class="opacity-5 text-white" href="<?= base_url('master/matakuliah') ?>">Mata Kuliah</a>
          </li>
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tambah</li>
        </ol>
        <h3 class="font-weight-bolder text-white mb-0">Tambah Data Mata Kuliah</h3>
      </nav>
    </div>
  </nav>
  <!-- End Navbar -->

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Form Tambah Mata Kuliah</h5>
            <p class="text-sm mb-0">Lengkapi data mata kuliah di bawah ini</p>
          </div>

          <div class="card-body px-4 pt-4 pb-2">

            <?php if (isset($validation)): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Kesalahan!</strong> Periksa kembali data yang Anda masukkan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php endif; ?>

            <form action="<?= base_url('master/matakuliah/new') ?>" method="post" id="formMatakuliah">
              <div class="row">
                <!-- Nama Mata Kuliah -->
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label>Mata Kuliah <span class="text-danger">*</span></label>
                    <input type="text"
                      name="matakuliah"
                      class="form-control <?= isset($validation) && $validation->hasError('matakuliah') ? 'is-invalid' : '' ?>"
                      placeholder="Contoh: Pemrograman Web"
                      value="<?= old('matakuliah') ?>"
                      required>
                    <div class="invalid-feedback">
                      <?= $validation->getError('matakuliah') ?? '' ?>
                    </div>
                  </div>
                </div>

                <!-- Kode -->
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label>Kode Mata Kuliah <span class="text-danger">*</span></label>
                    <input type="text"
                      name="kode"
                      class="form-control <?= isset($validation) && $validation->hasError('kode') ? 'is-invalid' : '' ?>"
                      placeholder="Contoh: IF203"
                      value="<?= old('kode') ?>"
                      required>
                    <div class="invalid-feedback">
                      <?= $validation->getError('kode') ?? '' ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Rumpun -->
                <div class="col-md-4">
                  <div class="form-group mb-3">
                    <label>Rumpun <span class="text-danger">*</span></label>
                    <input type="text"
                      name="rumpun"
                      class="form-control"
                      placeholder="Contoh: Rekayasa Perangkat Lunak"
                      value="<?= old('rumpun') ?>"
                      required>
                  </div>
                </div>

                <!-- Bobot Teori -->
                <div class="col-md-4">
                  <div class="form-group mb-3">
                    <label>Bobot Teori (SKS) <span class="text-danger">*</span></label>
                    <input type="number"
                      name="bobot_teori"
                      class="form-control"
                      min="0"
                      value="<?= old('bobot_teori') ?>"
                      required>
                  </div>
                </div>

                <!-- Bobot Praktik -->
                <div class="col-md-4">
                  <div class="form-group mb-3">
                    <label>Bobot Praktik (SKS) <span class="text-danger">*</span></label>
                    <input type="number"
                      name="bobot_praktek"
                      class="form-control"
                      min="0"
                      value="<?= old('bobot_praktek') ?>"
                      required>
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- Semester -->
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label>Semester <span class="text-danger">*</span></label>
                    <select name="semester" class="form-control" required>
                      <option value="">-- Pilih Semester --</option>
                      <?php for ($i = 1; $i <= 8; $i++): ?>
                        <option value="<?= $i ?>" <?= old('semester') == $i ? 'selected' : '' ?>>
                          Semester <?= $i ?>
                        </option>
                      <?php endfor; ?>
                    </select>
                  </div>
                </div>

                <!-- Tanggal -->
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label>Tanggal Berlaku <span class="text-danger">*</span></label>
                    <input type="date"
                      name="tanggal"
                      class="form-control"
                      value="<?= old('tanggal') ?>"
                      required>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="<?= base_url('master/matakuliah') ?>" class="btn btn-outline-secondary">
                  <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <button type="reset" class="btn btn-outline-warning">
                  <i class="fas fa-redo me-1"></i>Reset
                </button>
                <button type="submit" class="btn bg-gradient-primary">
                  <i class="fas fa-save me-1"></i>Simpan
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
document.getElementById('formMatakuliah').addEventListener('submit', function(e) {
  const requiredFields = ['matakuliah', 'kode', 'rumpun', 'bobot_teori', 'bobot_praktek', 'semester', 'tanggal'];
  for (let field of requiredFields) {
    if (!document.querySelector(`[name="${field}"]`).value) {
      e.preventDefault();
      alert('Semua field wajib diisi!');
      return false;
    }
  }
});
</script>

<?= $this->endSection() ?>
