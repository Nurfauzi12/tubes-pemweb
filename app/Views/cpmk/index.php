<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
              <a class="opacity-5 text-white" href="javascript:;">Master Data</a>
            </li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">CPMK</li>
          </ol>
          <h3 class="font-weight-bolder text-white mb-0">Data CPMK</h3>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <form action="<?= base_url('master/cpmk/cari') ?>" method="GET" id="searchForm">
                <span class="input-group-text text-body">
                  <input type="search" id="searchInput" name="search" placeholder="Cari CPMK..." />
                  <i class="fas fa-search" aria-hidden="true"></i>
                </span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-0">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5>Master Data CPMK</h5>
                  <h6 class="text-sm">Daftar CPMK</h6>
                </div>
              </div>

              <!-- Flash Messages -->
              <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3">
                  <?= session()->getFlashdata('success') ?>
                </div>
              <?php endif; ?>

              <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3">
                  <?= session()->getFlashdata('error') ?>
                </div>
              <?php endif; ?>

              <!-- Button Tambah Data -->
              <a href="<?= base_url('table/cpmk/new') ?>" class="btn bg-gradient-success mb-3 mt-3">
                <i class="fas fa-plus me-2"></i>Tambah CPMK
              </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs">No</th>
                      <th class="text-uppercase text-secondary text-xxs ps-4">Penyusun</th>
                      <th class="text-uppercase text-secondary text-xxs">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs text-center">CPMK</th>
                      <th class="text-center text-uppercase text-secondary text-xxs">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php if (empty($cpmk)): ?>
                          <tr>
                              <td colspan="5" class="text-center py-4">
                                  <p class="text-sm text-secondary mb-0">Tidak ada data</p>
                              </td>
                          </tr>
                      <?php else: ?>
                          <?php $no = 1; foreach ($cpmk as $item): ?>
                              <tr>
                                  <td class="text-center">
                                      <p class="mb-0 text-sm"><?= $no++ ?></p>
                                  </td>

                                  <td class="ps-4">
                                      <div class="d-flex flex-column justify-content-center">
                                          <h6 class="mb-0 text-sm">
                                              <?= esc($item['nama_penyusun'] ?? '-') ?>
                                          </h6>
                                      </div>
                                  </td>

                                  <td>
                                      <div class="d-flex flex-column justify-content-center">
                                          <p class="text-sm font-weight-bold mb-0">
                                              <?= esc($item['nama_matkul'] ?? '-') ?>
                                          </p>
                                          <p class="text-xs text-secondary mb-0">
                                              <?= esc($item['kode_matkul'] ?? '-') ?>
                                          </p>
                                      </div>
                                  </td>

                                  <td class="text-center">
                                      <p class="text-sm mb-0"><?= esc($item['cpmk']) ?></p>
                                  </td>

                                  <td class="text-center">
                                      <a href="<?= base_url('master/cpmk/'.$item['id'].'/edit') ?>" 
                                        class="btn btn-sm bg-gradient-info mb-0">
                                          <i class="fas fa-edit"></i> Edit
                                      </a>
                                      <a href="javascript:;" 
                                        data-href="<?= base_url('master/cpmk/'.$item['id'].'/delete') ?>"
                                        onclick="confirmToDelete(this)"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirm-dialog"
                                        class="btn btn-sm bg-gradient-danger mb-0">
                                          <i class="fas fa-trash"></i> Hapus
                                      </a>
                                  </td>
                              </tr>
                          <?php endforeach ?>
                      <?php endif ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="confirm-dialog" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi Hapus</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus CPMK ini?
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-danger" id="deleteButton">Hapus</button>
          </div>
        </div>
      </div>
    </div>
</main>

<body class="g-sidenav-show bg-primary">
  <div class="min-height-300 bg-gray-100 position-absolute w-100"></div>

  <script>
    // Delete confirmation
    function confirmToDelete(element) {
      var getHref = element.getAttribute('data-href');
      document.getElementById('confirm-dialog').querySelector('button.btn-danger').onclick = function() {
        window.location.href = getHref;
      };
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  </script>
</body>

<?= $this->endSection() ?>
