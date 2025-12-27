<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <h5>Data SUB CPMK</h5>
            <button class="btn btn-primary btn-sm mt-3"
        data-bs-toggle="modal"
        data-bs-target="#modalCreate">
    + Tambah SUB CPMK
</button>

        </div>

        <div class="card-body px-4 pt-4 pb-2">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Penyusun</th>
                        <th>Mata Kuliah</th>
                        <th>Sub CPMK</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subcpmk as $s): ?>
                        <tr>
                            <td><?= $s['id'] ?></td>
                            <td><?= esc($s['penyusun_nama']) ?></td>
                            <td><?= esc($s['matakuliah_nama']) ?></td>
                            <td><?= esc($s['sub_cpmk']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit"
                                    data-id="<?= $s['id'] ?>"
                                    data-idpenyusun="<?= $s['id_penyusun'] ?>"
                                    data-idmatakuliah="<?= $s['id_matakuliah'] ?>"
                                    data-subcpmk="<?= esc($s['sub_cpmk']) ?>">Edit</button>

                                <!-- Tombol Hapus yang Memanggil Modal -->
                                <button type="button" class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirm-dialog"
                                    data-id="<?= $s['id'] ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL CREATE SUB CPMK -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <form action="<?= base_url('table/subcpmk/store') ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Tambah SUB CPMK</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <div class="form-group mb-3">
            <label>Penyusun</label>
            <select name="id_penyusun" class="form-control" required>
              <option value="">Pilih Penyusun</option>
              <?php foreach ($penyusun as $p): ?>
                <option value="<?= $p['id'] ?>"><?= esc($p['pengembangan_rps']) ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group mb-3">
            <label>Mata Kuliah</label>
            <select name="id_matakuliah" class="form-control" required>
              <option value="">Pilih Mata Kuliah</option>
              <?php foreach ($matakuliah as $m): ?>
                <option value="<?= $m['id'] ?>"><?= esc($m['matakuliah']) ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>Sub CPMK</label>
            <textarea name="sub_cpmk" class="form-control" rows="3" required></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDIT SUB CPMK -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <form action="<?= base_url('table/subcpmk/update') ?>" method="post" id="formEdit">

        <div class="modal-header">
          <h5 class="modal-title">Edit SUB CPMK</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <!-- ID Sub CPMK (hidden field) -->
          <input type="hidden" name="id" id="edit_id">

          <div class="form-group mb-3">
            <label>Penyusun</label>
            <select name="id_penyusun" class="form-control" id="edit_penyusun" required>
              <option value="">Pilih Penyusun</option>
              <?php foreach ($penyusun as $p): ?>
                <option value="<?= $p['id'] ?>"><?= esc($p['pengembangan_rps']) ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group mb-3">
            <label>Mata Kuliah</label>
            <select name="id_matakuliah" class="form-control" id="edit_matakuliah" required>
              <option value="">Pilih Mata Kuliah</option>
              <?php foreach ($matakuliah as $m): ?>
                <option value="<?= $m['id'] ?>"><?= esc($m['matakuliah']) ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label>Sub CPMK</label>
            <textarea name="sub_cpmk" class="form-control" id="edit_subcpmk" rows="3" required></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning">Update</button>
        </div>
      </form>
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
                <p class="mb-0">Apakah Anda yakin ingin menghapus data Sub CPMK ini?</p>
                <small class="text-danger">Data yang terhubung dengan Sub CPMK ini akan ikut terhapus.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="deleteButton">
                    <i class="fas fa-trash me-1"></i>Hapus
                </button>
            </div>
        </div>
    </div>
</div>



</main>
<script>
const modalCreate = document.getElementById('modalCreate');
modalCreate.addEventListener('hidden.bs.modal', function () {
  modalCreate.querySelector('form').reset();
});
document.getElementById('modalEdit').addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget; // Tombol yang diklik
  var id = button.getAttribute('data-id');
  var penyusun = button.getAttribute('data-idpenyusun');
  var matakuliah = button.getAttribute('data-idmatakuliah');
  var subcpmk = button.getAttribute('data-subcpmk');
  
  // Set data ke dalam modal form
  document.getElementById('edit_id').value = id;
  document.getElementById('edit_penyusun').value = penyusun;
  document.getElementById('edit_matakuliah').value = matakuliah;
  document.getElementById('edit_subcpmk').value = subcpmk;
});
document.getElementById('confirm-dialog')
  .addEventListener('show.bs.modal', function (event) {

    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');

    const deleteUrl = "<?= base_url('table/subcpmk/delete/') ?>" + id;

    const deleteBtn = document.getElementById('deleteButton');
    deleteBtn.onclick = function () {
        window.location.href = deleteUrl;
    };
});

</script>

<?= $this->endSection() ?>
