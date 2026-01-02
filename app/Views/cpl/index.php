<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
  <h3>Data CPL</h3>

  <a href="/cpl/create" class="btn btn-primary mb-3">+ Tambah CPL</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Penyusun</th>
        <th>Mata Kuliah</th>
        <th>CPL Prodi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; foreach($cpl as $row): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['pengembangan_rps'] ?></td>
        <td><?= $row['matakuliah'] ?></td>
        <td><?= $row['cpl_prodi'] ?></td>
        <td>
          <a href="/cpl/delete/<?= $row['id'] ?>" 
             class="btn btn-danger btn-sm"
             onclick="return confirm('Hapus CPL?')">Delete</a>
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
