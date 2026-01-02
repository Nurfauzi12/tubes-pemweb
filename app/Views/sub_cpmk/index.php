<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Tables</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Sub CPMK</li>
          </ol>
          <h3 class="font-weight-bolder text-white mb-0">Data SUB CPMK</h3>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <form action="<?= base_url('table/subcpmk/cari') ?>" method="GET" id="searchForm">
                <span class="input-group-text text-body"><input type="search" id="searchInput" name="search" placeholder="Cari berdasarkan penyusun / mata kuliah / sub cpmk.." /><i class="fas fa-search" aria-hidden="true"></i></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-0">
            <div class="card-header pb-0">
              <h5>Sub CPMK</h5>
              <h6 class="text-sm">Data Sub CPMK berdasarkan mata kuliah</h6>

              <!-- Flash Messages -->
              <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                  <span class="alert-text"><?= session()->getFlashdata('success') ?></span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>

              <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                  <span class="alert-text"><?= session()->getFlashdata('error') ?></span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif; ?>
              <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah Data</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-4">Penyusun</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Mata Kuliah</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Sub CPMK</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($subcpmk)): ?>
                      <tr>
                        <td colspan="5" class="text-center py-4">
                          <p class="text-sm text-secondary mb-0">Tidak ada data</p>
                        </td>
                      </tr>
                    <?php else: ?>
                      <?php $no = 1; foreach ($subcpmk as $s): ?>
                        <tr>
                          <td class="text-center"><p class="mb-0 text-sm"><?= $no++; ?></p></td>
                          <td>
                            <div class="d-flex px-3 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"><?= esc($s['penyusun_nama']) ?></h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-sm font-weight-normal mb-0"><?= esc($s['matakuliah_nama']) ?></p>
                          </td>
                          <td>
                            <p class="text-sm font-weight-normal mb-0"><?= esc($s['sub_cpmk']) ?></p>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-sm bg-gradient-info mb-0 me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEdit"
                                data-id="<?= $s['id'] ?>"
                                data-idpenyusun="<?= $s['id_penyusun'] ?>"
                                data-idmatakuliah="<?= $s['id_matakuliah'] ?>"
                                data-subcpmk="<?= esc($s['sub_cpmk']) ?>" title="Edit">Edit</button>
                            <button type="button" class="btn btn-sm bg-gradient-danger mb-0"
                                data-bs-toggle="modal"
                                data-bs-target="#confirm-dialog"
                                data-id="<?= $s['id'] ?>" title="Hapus">Hapus</button>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
                <div id="resultMessage" class="result-message text-center"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="confirm-dialog" tabindex="-1" aria-labelledby="confirmDialogLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmDialogLabel">Konfirmasi Hapus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus data ini?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger" onclick="deleteData()">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true" style="z-index: 999999;">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <h3 class="font-weight-bolder text-primary text-gradient">Tambah Sub CPMK</h3>
              </div>
              <div class="card-body pb-3">
                <form action="<?= base_url('table/subcpmk/store') ?>" method="post" role="form text-left">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Penyusun</label>
                      <div class="input-group mb-3">
                        <select name="id_penyusun" class="form-control" required>
                          <option value="">Pilih Penyusun</option>
                          <?php foreach ($penyusun as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= esc($p['pengembangan_rps']) ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label>Mata Kuliah</label>
                      <div class="input-group mb-3">
                        <select name="id_matakuliah" class="form-control" required>
                          <option value="">Pilih Mata Kuliah</option>
                          <?php foreach ($matakuliah as $m): ?>
                            <option value="<?= $m['id'] ?>"><?= esc($m['matakuliah']) ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Sub CPMK</label>
                      <div class="input-group mb-3">
                        <textarea name="sub_cpmk" class="form-control" rows="3" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Tambah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true" style="z-index: 999999;">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <h3 class="font-weight-bolder text-primary text-gradient">Edit Sub CPMK</h3>
              </div>
              <div class="card-body pb-3">
                <form action="<?= base_url('table/subcpmk/update') ?>" method="post" role="form text-left" id="formEdit">
                  <input type="hidden" name="id" id="edit_id">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Penyusun</label>
                      <div class="input-group mb-3">
                        <select name="id_penyusun" class="form-control" id="edit_penyusun" required>
                          <option value="">Pilih Penyusun</option>
                          <?php foreach ($penyusun as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= esc($p['pengembangan_rps']) ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label>Mata Kuliah</label>
                      <div class="input-group mb-3">
                        <select name="id_matakuliah" class="form-control" id="edit_matakuliah" required>
                          <option value="">Pilih Mata Kuliah</option>
                          <?php foreach ($matakuliah as $m): ?>
                            <option value="<?= $m['id'] ?>"><?= esc($m['matakuliah']) ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Sub CPMK</label>
                      <div class="input-group mb-3">
                        <textarea name="sub_cpmk" class="form-control" id="edit_subcpmk" rows="3" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Update</button>
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

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const searchForm = document.getElementById("searchForm");
        const searchInput = document.getElementById("searchInput");
        const resultMessage = document.getElementById("resultMessage");
        const tableBody = document.querySelector(".table tbody");

        function filterRows() {
          const searchText = searchInput.value.toLowerCase();
          let foundRows = 0;

          tableBody.querySelectorAll("tr").forEach(function(row) {
            if (row.querySelector('td[colspan]')) return;
            const cells = row.querySelectorAll("td");
            const penyusun = cells[1]?.textContent.toLowerCase() || '';
            const matakuliah = cells[2]?.textContent.toLowerCase() || '';
            const subcpmk = cells[3]?.textContent.toLowerCase() || '';

            if (penyusun.includes(searchText) || matakuliah.includes(searchText) || subcpmk.includes(searchText)) {
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

        searchForm.addEventListener("submit", function(e) { e.preventDefault(); filterRows(); });
        searchInput.addEventListener("input", filterRows);
      });

      document.getElementById('modalEdit').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var penyusun = button.getAttribute('data-idpenyusun');
        var matakuliah = button.getAttribute('data-idmatakuliah');
        var subcpmk = button.getAttribute('data-subcpmk');
        
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_penyusun').value = penyusun;
        document.getElementById('edit_matakuliah').value = matakuliah;
        document.getElementById('edit_subcpmk').value = subcpmk;
      });

      function confirmToDelete(element) {
        var deleteButton = document.getElementById('confirm-dialog').querySelector('.btn-danger');
        deleteButton.setAttribute('data-href', element.getAttribute('data-href'));
      }

      function deleteData() {
        var deleteUrl = event.target.getAttribute('data-href');
        if (!deleteUrl) {
          var button = document.getElementById('confirm-dialog').querySelector('.btn-danger');
          deleteUrl = button.getAttribute('data-href');
        }
        if (deleteUrl) {
          window.location.href = deleteUrl;
        }
      }

      document.getElementById('confirm-dialog').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var deleteUrl = "<?= base_url('table/subcpmk/delete/') ?>" + id;
        var deleteBtn = this.querySelector('.btn-danger');
        deleteBtn.setAttribute('data-href', deleteUrl);
      });
    </script>
  </body>

<?= $this->endSection() ?>
