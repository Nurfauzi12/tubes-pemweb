<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Dosen Pengampu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Edit Dosen Pengampu</h3>

<form action="<?= base_url('dosen-pengampu/update/'.$dosen_pengampu['id']) ?>" method="post">
    <div class="mb-3">
        <label>ID Penyusun</label>
        <input type="number" name="id_penyusun" class="form-control"
               value="<?= esc($dosen_pengampu['id_penyusun']) ?>" required>
    </div>

    <div class="mb-3">
        <label>ID Matakuliah</label>
        <input type="number" name="id_matakuliah" class="form-control"
               value="<?= esc($dosen_pengampu['id_matakuliah']) ?>" required>
    </div>

    <div class="mb-3">
        <label>Dosen Pengampu</label>
        <input type="text" name="dosen_pengampu" class="form-control"
               value="<?= esc($dosen_pengampu['dosen_pengampu']) ?>" required>
    </div>

    <div class="mb-3">
        <label>Semester</label>
        <input type="text" name="semester" class="form-control"
               value="<?= esc($dosen_pengampu['semester']) ?>" required>
    </div>

    <div class="mb-3">
        <label>Tahun Akademik</label>
        <input type="text" name="tahun_akademik" class="form-control"
               value="<?= esc($dosen_pengampu['tahun_akademik']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('dosen-pengampu') ?>" class="btn btn-secondary">Kembali</a>
</form>

</body>
</html>
