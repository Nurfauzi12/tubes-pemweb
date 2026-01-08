<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
         id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-white" href="<?= base_url('master/cpl') ?>">
                            Master Data
                        </a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                        Edit CPL
                    </li>
                </ol>
                <h3 class="font-weight-bolder text-white mb-0">
                    Edit Capaian Pembelajaran Lulusan
                </h3>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Edit Data CPL</h5>
                        <p class="text-sm mb-0">
                            Perbarui capaian pembelajaran lulusan sesuai RPS
                        </p>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url('master/cpl/' . $cpl['id'] . '/update') ?>"
                              method="post">

                            <!-- Penyusun -->
                            <label class="form-label">
                                Penyusun <span class="text-danger">*</span>
                            </label>
                            <div class="input-group mb-3">
                                <select name="id_penyusun" class="form-control" required>
                                    <option value="">-- Pilih Penyusun --</option>
                                    <?php foreach ($penyusun as $p): ?>
                                        <option value="<?= esc($p['id']) ?>"
                                            <?= $p['id'] == $cpl['id_penyusun'] ? 'selected' : '' ?>>
                                            <?= esc($p['pengembangan_rps']) ?>
                                            (<?= esc($p['koordinator_rumpun']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Mata Kuliah -->
                            <label class="form-label">
                                Mata Kuliah <span class="text-danger">*</span>
                            </label>
                            <div class="input-group mb-3">
                                <select name="id_matakuliah" class="form-control" required>
                                    <option value="">-- Pilih Mata Kuliah --</option>
                                    <?php foreach ($matakuliah as $m): ?>
                                        <option value="<?= esc($m['id']) ?>"
                                            <?= $m['id'] == $cpl['id_matakuliah'] ? 'selected' : '' ?>>
                                            <?= esc($m['kode']) ?> - <?= esc($m['matakuliah']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- CPL Prodi -->
                            <label class="form-label">
                                Deskripsi CPL <span class="text-danger">*</span>
                            </label>
                            <div class="input-group mb-4">
                                <textarea name="cpl_prodi"
                                          class="form-control"
                                          rows="4"
                                          placeholder="Contoh: Mampu menerapkan konsep algoritma dan pemrograman untuk menyelesaikan permasalahan komputasi"
                                          required><?= esc($cpl['cpl_prodi']) ?></textarea>
                            </div>

                            <!-- Action -->
                            <div class="text-center">
                                <button type="submit"
                                        class="btn bg-gradient-primary btn-lg w-100">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Perubahan
                                </button>

                                <a href="<?= base_url('master/cpl') ?>"
                                   class="btn btn-light w-100 mt-2">
                                    Batal
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>
