<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Table</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">CPL</li>
          </ol>
          <h3 class="font-weight-bolder text-white mb-0">Capaian Pembelajaran Lulusan</h3>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <form action="<?= base_url('table/cpl/cari') ?>" method="GET" id="searchForm">
                <span class="input-group-text text-body">
                  <input type="search" id="searchInput" name="search" placeholder="Cari CPL..." />
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
                  <h5>Data Capaian Pembelajaran Lulusan (CPL)</h5>
                  <h6 class="text-sm">Daftar capaian pembelajaran lulusan program studi</h6>
                </div>
              </div>

              <!-- Flash Messages -->
              <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                  <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                  <span class="alert-text"><?= session()->getFlashdata('success') ?></span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>

              <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                  <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                  <span class="alert-text"><?= session()->getFlashdata('error') ?></span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>

              <!-- Button Tambah Data -->
              <button type="button" class="btn bg-gradient-success btn-block mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
                <i class="fas fa-plus me-2"></i>Tambah Data CPL
              </button>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-4">CPL Prodi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">Penyusun</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($cpl)): ?>
                      <tr>
                        <td colspan="5" class="text-center py-4">
                          <p class="text-sm text-secondary mb-0">Tidak ada data CPL</p>
                        </td>
                      </tr>
                    <?php else: ?>
                      <?php $no = 1; foreach ($cpl as $item): ?>
                        <tr>
                          <td class="text-center">
                            <p class="mb-0 text-sm"><?= $no++; ?></p>
                          </td>
                          <td>
                            <div class="d-flex px-3 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?= esc($item['cpl_prodi']) ?></h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-sm font-weight-normal mb-0">
                              <?= esc($item['nama_matakuliah'] ?? '-') ?>
                              <?php if (!empty($item['kode_matakuliah'])): ?>
                                <small class="text-secondary">(<?= esc($item['kode_matakuliah']) ?>)</small>
                              <?php endif; ?>
                            </p>
                          </td>
                          <td>
                            <p class="text-sm mb-0"><?= esc($item['pengembangan_rps'] ?? '-') ?></p>
                          </td>
                          <td class="text-center">
                            <a href="<?= base_url('table/cpl/'.$item['id'].'/edit') ?>"
                               class="btn btn-sm bg-gradient-info mb-0 me-2"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="Edit Data">
                              <i class="fas fa-pencil-alt me-1"></i>Edit
                            </a>
                            <a href="#"
                               data-href="<?= base_url('table/cpl/' . $item['id'] . '/delete') ?>"
                               onclick="confirmToDelete(this)"
                               class="btn btn-sm bg-gradient-danger mb-0"
                               data-bs-toggle="modal"
                               data-bs-target="#confirm-dialog"
                               title="Hapus Data">
                              <i class="fas fa-trash me-1"></i>Hapus
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>

                <!-- Message when no data found from search -->
                <div id="resultMessage" class="result-message text-center"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div class="modal fade" id="confirm-dialog" tabindex="-1" aria-labelledby="confirmDialogLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmDialogLabel">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0">Apakah Anda yakin ingin menghapus data CPL ini?</p>
            <small class="text-danger">Data yang sudah dihapus tidak dapat dikembalikan.</small>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" onclick="deleteData()">
              <i class="fas fa-trash me-1"></i>Hapus
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true" style="z-index: 999999;">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <h3 class="font-weight-bolder text-primary text-gradient">Tambah Data CPL</h3>
                <p class="mb-0">Masukkan data capaian pembelajaran lulusan</p>
              </div>
              <div class="card-body pb-3">
                <form action="<?= base_url('table/cpl/new') ?>" method="post" role="form">
                  <label>CPL Prodi <span class="text-danger">*</span></label>
                  <div class="input-group mb-3">
                    <textarea class="form-control"
                              name="cpl_prodi"
                              rows="3"
                              placeholder="Masukkan capaian pembelajaran lulusan program studi"
                              required
                              maxlength="255"></textarea>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label>Penyusun <span class="text-danger">*</span></label>
                      <div class="input-group mb-3">
                        <select name="id_penyusun" class="form-control" required>
                          <option value="">Pilih Penyusun</option>
                          <?php foreach ($penyusunList as $p): ?>
                            <option value="<?= esc($p['id']) ?>"><?= esc($p['pengembangan_rps']) ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label>Mata Kuliah <span class="text-danger">*</span></label>
                      <div class="input-group mb-3">
                        <select name="id_matakuliah" class="form-control" required>
                          <option value="">Pilih Mata Kuliah</option>
                          <?php foreach ($matakuliahList as $mk): ?>
                            <option value="<?= esc($mk['id']) ?>"><?= esc($mk['matakuliah']) ?> (<?= esc($mk['kode']) ?>)</option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">
                      <i class="fas fa-save me-2"></i>Simpan Data
                    </button>
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

  <!-- JavaScript for Search and Delete Confirmation -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const searchForm = document.getElementById("searchForm");
      const searchInput = document.getElementById("searchInput");
      const resultMessage = document.getElementById("resultMessage");
      const tableBody = document.querySelector(".table tbody");

      // Search functionality
      function filterRows() {
        const searchText = searchInput.value.toLowerCase();
        let foundRows = 0;

        tableBody.querySelectorAll("tr").forEach(function(row) {
          // Skip if it's the "no data" row
          if (row.querySelector('td[colspan]')) {
            return;
          }

          const cells = row.querySelectorAll("td");
          const cplProdi = cells[1]?.textContent.toLowerCase() || '';
          const matakuliah = cells[2]?.textContent.toLowerCase() || '';
          const penyusun = cells[3]?.textContent.toLowerCase() || '';

          if (cplProdi.includes(searchText) || matakuliah.includes(searchText) || penyusun.includes(searchText)) {
            row.style.display = "";
            foundRows++;
          } else {
            row.style.display = "none";
          }
        });

        if (foundRows === 0 && searchText !== "") {
          resultMessage.innerHTML = '<div class="alert alert-warning mt-3" role="alert">Data tidak ditemukan</div>';
        } else {
          resultMessage.textContent = "";
        }
      }

      searchForm.addEventListener("submit", function(event) {
        event.preventDefault();
        filterRows();
      });

      searchInput.addEventListener("input", filterRows);
    });

    // Delete confirmation
    function confirmToDelete(element) {
      var getHref = element.getAttribute('data-href');
      document.getElementById('confirm-dialog').querySelector('button.btn-danger').onclick = function() {
        window.location.href = getHref;
      };
    }

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  </script>
</body>

<?= $this->endSection() ?>
