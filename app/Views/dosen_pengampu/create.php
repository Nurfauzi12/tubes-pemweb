<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Dosen Pengampu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Tambah Dosen Pengampu</h3>

<form action="<?= base_url('dosen-pengampu/store') ?>" method="post">
    <div class="mb-3">
        <label>ID Penyusun</label>
        <input type="number" name="id_penyusun" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>ID Matakuliah</label>
        <input type="number" name="id_matakuliah" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Dosen Pengampu</label>
        <input type="text" name="dosen_pengampu" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Semester</label>
        <input type="text" name="semester" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tahun Akademik</label>
        <input type="text" name="tahun_akademik" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
<a href="<?= base_url('master/dosen-pengampu') ?>" class="btn btn-secondary">Kembali</a>
</form>

</body>
</html>
