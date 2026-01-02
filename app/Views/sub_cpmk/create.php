<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg">

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <h5>Tambah SUB CPMK</h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('table/subcpmk/store') ?>" method="post">

                <label>Penyusun</label>
                <select name="id_penyusun" class="form-control mb-3" required>
                    <option value="">Pilih Penyusun</option>
                    <?php foreach ($penyusun as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= esc($p['pengembangan_rps']) ?></option>
                    <?php endforeach ?>
                </select>

                <label>Mata Kuliah</label>
                <select name="id_matakuliah" class="form-control mb-3" required>
                    <option value="">Pilih Mata Kuliah</option>
                    <?php foreach ($matakuliah as $m): ?>
                        <option value="<?= $m['id'] ?>"><?= esc($m['matakuliah']) ?></option>
                    <?php endforeach ?>
                </select>

                <label>Sub CPMK</label>
                <textarea name="sub_cpmk" rows="3" class="form-control mb-3" required></textarea>

                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>

        </div>
    </div>
</div>

</main>

<?= $this->endSection() ?>
