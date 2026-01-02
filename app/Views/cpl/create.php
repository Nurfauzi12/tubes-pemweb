<div class="container mt-4">
  <h3>Tambah CPL</h3>

  <?php if(session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
      <?php foreach(session('errors') as $error): ?>
        <div><?= $error ?></div>
      <?php endforeach ?>
    </div>
  <?php endif ?>

  <form method="post" action="/cpl/store">
    <div class="mb-3">
      <label>Penyusun</label>
      <select name="id_penyusun" class="form-control" required>
        <option value="">-- Pilih --</option>
        <?php foreach($penyusun as $p): ?>
          <option value="<?= $p['id'] ?>"><?= $p['pengembangan_rps'] ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Mata Kuliah</label>
      <select name="id_matakuliah" class="form-control" required>
        <option value="">-- Pilih --</option>
        <?php foreach($matakuliah as $m): ?>
          <option value="<?= $m['id'] ?>"><?= $m['matakuliah'] ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="mb-3">
      <label>CPL Prodi</label>
      <textarea name="cpl_prodi" class="form-control" required></textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="/cpl" class="btn btn-secondary">Kembali</a>
  </form>
</div>
