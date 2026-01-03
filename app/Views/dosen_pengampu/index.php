<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dosen Pengampu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Data Dosen Pengampu</h3>

<a href="<?= base_url('master/dosen-pengampu/create') ?>" class="btn btn-primary">
    + Tambah Data
</a>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>ID Penyusun</th>
            <th>ID Matakuliah</th>
            <th>Dosen Pengampu</th>
            <th>Semester</th>
            <th>Tahun Akademik</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($dosen_pengampu as $dp) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($dp['id_penyusun']) ?></td>
            <td><?= esc($dp['id_matakuliah']) ?></td>
            <td><?= esc($dp['dosen_pengampu']) ?></td>
            <td><?= esc($dp['semester']) ?></td>
            <td><?= esc($dp['tahun_akademik']) ?></td>
            <td>
                <a href="<?= base_url('dosen-pengampu/edit/'.$dp['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('dosen-pengampu/delete/'.$dp['id']) ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin ingin menghapus?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>
</html>
