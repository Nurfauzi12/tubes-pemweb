<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <h5>Data SUB CPMK</h5>
            <a href="<?= base_url('table/subcpmk/create') ?>" class="btn btn-primary btn-sm mt-3">
                + Tambah SUB CPMK
            </a>
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
                                <a href="<?= base_url('table/subcpmk/edit/'.$s['id']) ?>"
                                   class="btn btn-warning btn-sm">Edit</a>

                                <a href="<?= base_url('table/subcpmk/delete/'.$s['id']) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</main>

<?= $this->endSection() ?>
