<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Master Data</a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="<?= base_url('master/matakuliah-syarat') ?>">Mata Kuliah Syarat</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit</li>
          </ol>
          <h3 class="font-weight-bolder text-white mb-0">Edit Mata Kuliah Syarat</h3>
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
                  <h5>Form Edit Mata Kuliah Syarat</h5>
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

              <form action="" method="post" id="formMkSyaratEdit">
                <input type="hidden" name="id" value="<?= $item['id'] ?>" />

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="id_matakuliah" class="form-control-label">Mata Kuliah <span class="text-danger">*</span></label>
                      <select name="id_matakuliah" id="id_matakuliah" class="form-control" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        <?php foreach (($matakuliah_list ?? []) as $m): ?>
                          <option value="<?= $m['id'] ?>" <?= $m['id'] == $item['id_matakuliah'] ? 'selected' : '' ?>><?= esc($m['matakuliah']) ?> (<?= esc($m['kode']) ?>)</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-4">
                      <label for="id_penyusun" class="form-control-label">Penyusun</label>
                      <select name="id_penyusun" id="id_penyusun" class="form-control">
                        <option value="">-- Pilih Penyusun (opsional) --</option>
                        <?php foreach (($penyusun_list ?? []) as $p): ?>
                          <option value="<?= $p['id'] ?>" <?= $p['id'] == $item['id_penyusun'] ? 'selected' : '' ?>><?= esc($p['pengembangan_rps']) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group mb-4">
                      <label for="mk_syarat" class="form-control-label">Mata Kuliah Syarat <span class="text-danger">*</span></label>
                      <input type="text" name="mk_syarat" id="mk_syarat" class="form-control <?= isset($validation) && $validation->hasError('mk_syarat') ? 'is-invalid' : '' ?>" placeholder="Masukkan nama mata kuliah syarat" value="<?= old('mk_syarat', $item['mk_syarat']) ?>" required>
                      <?php if (isset($validation) && $validation->hasError('mk_syarat')): ?>
                        <div class="invalid-feedback"><?= $validation->getError('mk_syarat') ?></div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-12 d-flex justify-content-end gap-2">
                    <a href="<?= base_url('master/matakuliah-syarat') ?>" class="btn btn-outline-secondary">Kembali</a>
                    <button type="reset" class="btn btn-outline-warning">Reset</button>
                    <button type="submit" class="btn bg-gradient-success">Simpan Perubahan</button>
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
    document.getElementById('formMkSyaratEdit').addEventListener('submit', function(e) {
      const mk = document.getElementById('mk_syarat').value.trim();
      const matkul = document.getElementById('id_matakuliah').value;
      if (!matkul || !mk) {
        e.preventDefault();
        alert('Field bertanda * wajib diisi');
        return false;
      }
    });
  </script>
</body>

<?= $this->endSection() ?>
