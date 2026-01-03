<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tables</li>
          </ol>
          <h3 class="font-weight-bolder text-white mb-0">Rencana Pembelajaran</h3>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
            <form action="<?= base_url('table/rencana-pembelajaran/cari') ?>" method="GET" id="searchForm">
              <span class="input-group-text text-body"><input type="search" id="searchInput" name="search" placeholder="Cari berdasarkan minggu ke.." /><i class="fas fa-search" aria-hidden="true"></i></span>
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
              <h5>Rencana Pembelajaran</h5>
              <h6>Data rencana pembelajaran per minggu</h6>
              <!-- button tambah -->
              <button type="button"  class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
                Tambah Data
              </button>
              <br>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table table-hover align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Minggu Ke</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Sub CPMK</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Materi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Bentuk Pembelajaran</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Bobot Penilaian</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; foreach ($rencana_pembelajaran as $rencana): ?>
                    <tr>
                     <td class="text-center">
                          <p class="mb-0 text-sm"><?= $no; ?></p>
                     </td>
                      <td class="text-center">
                            <p class="mb-0 text-sm"><?= $rencana['minggu_ke'] ?></p>
                      </td>
                      <td class="text-center">
                        <p class="mb-0 text-sm"><?= $rencana['sub_cpmk'] ?></p>
                      </td>
                      <td class="text-center">
                        <p class="mb-0 text-sm"><?= $rencana['materi'] ?></p>
                      </td>
                      <td class="text-center">
                        <p class="mb-0 text-sm"><?= $rencana['bentuk_pembelajaran'] ?></p>
                      </td>
                      <td class="text-center">
                        <p class="mb-0 text-sm"><?= $rencana['bobot_penilaian'] ?></p>
                      </td>
                      <td class="text-center">
                      <!-- aksi -->
                      <a href="<?= base_url('table/rencana-pembelajaran/'.$rencana['id'].'/edit') ?>" class="btn bg-gradient-info btn-block">
                        Edit
                      </a>
                      <a href="#" data-href="<?= base_url('table/rencana-pembelajaran/' . $rencana['id'] . '/delete') ?>" onclick="confirmToDelete(this)" class="btn bg-gradient-danger btn-block" data-bs-toggle="modal" data-bs-target="#confirm-dialog">Hapus</a>
                      </td>
                      <!-- ------------------------------------ -->
                    </tr>
                    <?php $no++; endforeach ?>
                  </tbody>
                </table>

                <!-- js message data tidak ditemukan  -->
                <div id="resultMessage" class="result-message text-center"></div>

                <!-- modal delete -->
                <div class="modal fade" id="confirm-dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
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

                <!-- modal create -->
                <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true" style="z-index: 999999;">
                  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card card-plain">
                          <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient">Rencana Pembelajaran</h3>
                              <p class="mb-0">Masukkan data rencana pembelajaran</p>
                          </div>
                              <div class="card-body pb-3">
                                <form action="<?= base_url('table/rencana-pembelajaran/new') ?>"  method="post" role="form text-left">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label>ID Penyusun</label>
                                      <div class="input-group mb-3">
                                        <select name="id_penyusun" class="form-control" required>
                                            <option value="">Pilih Penyusun</option>
                                            <?php foreach ($penyusun ?? [] as $p): ?>
                                                <option value="<?= $p['id'] ?>"><?= $p['pengembangan_rps'] ?> - <?= $p['koordinator_rumpun'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <label>ID Mata Kuliah</label>
                                      <div class="input-group mb-3">
                                        <select name="id_matakuliah" class="form-control" required>
                                            <option value="">Pilih Mata Kuliah</option>
                                            <?php foreach ($matakuliah ?? [] as $m): ?>
                                                <option value="<?= $m['id'] ?>"><?= $m['kode'] ?> - <?= $m['matakuliah'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <label>Minggu Ke</label>
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="minggu_ke" placeholder="Minggu Ke" required>
                                  </div>
                                  <label>Sub CPMK</label>
                                  <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="sub_cpmk" placeholder="Sub CPMK" required>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label>Penilaian Indikator</label>
                                      <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="penilaian_indikator" placeholder="Penilaian Indikator" required>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <label>Penilaian Teknik</label>
                                      <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="penilaian_teknik" placeholder="Penilaian Teknik" required>
                                      </div>
                                    </div>
                                  </div>
                                  <label>Bentuk Pembelajaran</label>
                                  <div class="input-group mb-3">
                                    <select name="bentuk_pembelajaran" class="form-control" required>
                                      <option value="">Pilih Bentuk Pembelajaran</option>
                                      <option value="luring">Luring</option>
                                      <option value="daring">Daring</option>
                                    </select>
                                  </div>
                                  <label>Materi</label>
                                  <div class="input-group mb-3">
                                    <textarea class="form-control" name="materi" placeholder="Materi" rows="3" required></textarea>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label>Bobot Penilaian</label>
                                      <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="bobot_penilaian" placeholder="Bobot Penilaian" required>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <label>Catatan</label>
                                      <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="catatan" placeholder="Catatan">
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
              </div>
            </div>
          </div>
        </div>
      </main>

  <body class="g-sidenav-show bg-primary">
  <div class="min-height-300 bg-gray-100 position-absolute w-100"></div>

<!-- js search -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const searchForm = document.getElementById("searchForm");
      const searchInput = document.getElementById("searchInput");
      const resultMessage = document.getElementById("resultMessage");
      const tableBody = document.querySelector(".table tbody");

      function filterRows() {
        const searchText = searchInput.value.toLowerCase();
        let foundRows = 0;

        tableBody.querySelectorAll("tr").forEach(function(row, index) {
          const cells = row.querySelectorAll("td");
          const mingguText = cells[1].textContent.toLowerCase();

          if (mingguText.includes(searchText)) {
            row.style.display = "";
            foundRows++;
          } else {
            row.style.display = "none";
          }
        });

        if (foundRows === 0) {
          resultMessage.textContent = "Data tidak ditemukan";
        } else {
          resultMessage.textContent = "";
        }
      }

      searchForm.addEventListener("submit", function(event) {
        event.preventDefault();
        filterRows();
      });

      searchInput.addEventListener("input", filterRows);

      filterRows();
    });

    function confirmToDelete(element) {
      var getHref = element.getAttribute('data-href');
      document.getElementById('confirm-dialog').querySelector('button.btn-danger').onclick = function() {
        window.location.href = getHref;
      };
    }
  </script>

  </body>

<?= $this->endSection() ?>