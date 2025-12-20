<?= $this->extend('layout/admin/layout') ?>

<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="<?= base_url('table/korelasi-cpl-cpmk') ?>">Korelasi CPL-CPMK</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tambah</li>
                </ol>
                <h3 class="font-weight-bolder text-white mb-0">Tambah Korelasi CPL-CPMK</h3>
            </nav>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header pb-0">
                        <h5>Form Tambah Korelasi CPL-CPMK</h5>
                        <p class="text-sm mb-0">Masukkan data korelasi CPL-CPMK baru</p>

                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger mt-3">Periksa kembali data yang dimasukkan.</div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <span class="alert-text"><?= session()->getFlashdata('error') ?></span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body px-4 pt-4 pb-2">
                        <form action="<?= base_url('table/korelasi-cpl-cpmk/new') ?>" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="id_penyusun">Penyusun</label>
                                    <div class="input-group mb-3">
                                        <select name="id_penyusun" class="form-control <?= isset($validation) && $validation->hasError('id_penyusun') ? 'is-invalid' : '' ?>" required>
                                            <option value="">Pilih Penyusun</option>
                                            <?php foreach ($penyusun ?? [] as $p): ?>
                                                <option value="<?= esc($p['id']) ?>" <?= old('id_penyusun') == $p['id'] ? 'selected' : '' ?>><?= esc($p['pengembangan_rps']) ?> - <?= esc($p['koordinator_rumpun']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (isset($validation) && $validation->hasError('id_penyusun')): ?>
                                            <div class="invalid-feedback"><?= $validation->getError('id_penyusun') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="id_matakuliah">Mata Kuliah</label>
                                    <div class="input-group mb-3">
                                        <select name="id_matakuliah" class="form-control <?= isset($validation) && $validation->hasError('id_matakuliah') ? 'is-invalid' : '' ?>" required>
                                            <option value="">Pilih Mata Kuliah</option>
                                            <?php foreach ($matakuliah ?? [] as $m): ?>
                                                <option value="<?= esc($m['id']) ?>" <?= old('id_matakuliah') == $m['id'] ? 'selected' : '' ?>><?= esc($m['kode']) ?> - <?= esc($m['matakuliah']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (isset($validation) && $validation->hasError('id_matakuliah')): ?>
                                            <div class="invalid-feedback"><?= $validation->getError('id_matakuliah') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="id_cpmk">CPMK</label>
                                    <div class="input-group mb-3">
                                        <select name="id_cpmk" class="form-control <?= isset($validation) && $validation->hasError('id_cpmk') ? 'is-invalid' : '' ?>" required>
                                            <option value="">Pilih CPMK</option>
                                            <?php foreach ($cpmk ?? [] as $c): ?>
                                                <option value="<?= esc($c['id']) ?>" <?= old('id_cpmk') == $c['id'] ? 'selected' : '' ?>><?= esc($c['cpmk']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (isset($validation) && $validation->hasError('id_cpmk')): ?>
                                            <div class="invalid-feedback"><?= $validation->getError('id_cpmk') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="id_sub_cpmk">Sub-CPMK (opsional)</label>
                                    <div class="input-group mb-3">
                                        <select name="id_sub_cpmk" class="form-control <?= isset($validation) && $validation->hasError('id_sub_cpmk') ? 'is-invalid' : '' ?>">
                                            <option value="">Pilih Sub CPMK</option>
                                            <?php foreach ($sub_cpmk ?? [] as $s): ?>
                                                <option value="<?= esc($s['id']) ?>" <?= old('id_sub_cpmk') == $s['id'] ? 'selected' : '' ?>><?= esc($s['sub_cpmk']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (isset($validation) && $validation->hasError('id_sub_cpmk')): ?>
                                            <div class="invalid-feedback"><?= $validation->getError('id_sub_cpmk') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="presentase">Presentase (%)</label>
                                    <div class="input-group mb-3">
                                        <input type="number" min="0" max="100" name="presentase" class="form-control <?= isset($validation) && $validation->hasError('presentase') ? 'is-invalid' : '' ?>" placeholder="0-100" value="<?= old('presentase') ?>" required>
                                        <?php if (isset($validation) && $validation->hasError('presentase')): ?>
                                            <div class="invalid-feedback"><?= $validation->getError('presentase') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="bobot_penilaian">Bobot Penilaian</label>
                                    <div class="input-group mb-3">
                                        <input type="number" min="0" name="bobot_penilaian" class="form-control <?= isset($validation) && $validation->hasError('bobot_penilaian') ? 'is-invalid' : '' ?>" placeholder="Bobot Penilaian" value="<?= old('bobot_penilaian') ?>" required>
                                        <?php if (isset($validation) && $validation->hasError('bobot_penilaian')): ?>
                                            <div class="invalid-feedback"><?= $validation->getError('bobot_penilaian') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <a href="<?= base_url('table/korelasi-cpl-cpmk') ?>" class="btn btn-outline-secondary">Batal</a>
                                <button type="submit" class="btn bg-gradient-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<body class="g-sidenav-show bg-primary">
    <div class="min-height-300 bg-gray-100 position-absolute w-100"></div>
</body>

<?= $this->endSection() ?>