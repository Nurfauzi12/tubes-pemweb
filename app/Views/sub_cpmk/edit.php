<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg">

<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <h5>Edit SUB CPMK</h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('table/sub-cpmk/update/'.$sub['id']) ?>" method="post">

                <label>Penyusun</label>
                <select name="id_penyusun" class="form-control mb-3" required>
                    <?php foreach ($penyusun as $p): ?>
                        <option value="<?= $p['id'] ?>"
                            <?= $sub['id_penyusun'] == $p['id'] ? 'selected' : '' ?>>
                            <?= esc($p['pengembangan_rps']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <label>Mata Kuliah</label>
                <select name="id_matakuliah" class="form-control mb-3" required>
                    <?php foreach ($matakuliah as $m): ?>
                        <option value="<?= $m['id'] ?>"
                            <?= $sub['id_matakuliah'] == $m['id'] ? 'selected' : '' ?>>
                            <?= esc($m['matakuliah']) ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <label>Sub CPMK</label>
                <textarea name="sub_cpmk" class="form-control mb-3" rows="3" required><?= esc($sub['sub_cpmk']) ?></textarea>

                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>

        </div>
    </div>
</div>

</main>

<?= $this->endSection() ?>
