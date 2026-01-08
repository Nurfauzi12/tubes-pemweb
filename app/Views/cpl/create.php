<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-white" href="<?= base_url('master/cpl') ?>">CPL</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                        Tambah CPL
                    </li>
                </ol>
                <h3 class="font-weight-bolder text-white mb-0">
                    Tambah Data CPL
                </h3>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Form Tambah CPL</h5>
                        <p class="text-sm mb-0">
                            Masukkan data Capaian Pembelajaran Lulusan
                        </p>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url('master/cpl/new') ?>" method="post">

                            <!-- Kode CPL -->
                            <label class="form-label">Kode CPL <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="text"
                                       name="kode_cpl"
                                       class="form-control"
                                       placeholder="Contoh: CPL-01"
                                       required>
                            </div>

                            <!-- Deskripsi CPL -->
                            <label class="form-label">Deskripsi CPL <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <textarea name="deskripsi"
                                          class="form-control"
                                          rows="4"
                                          placeholder="Deskripsi capaian pembelajaran lulusan"
                                          required></textarea>
                            </div>

                            <!-- Kategori CPL -->
                            <label class="form-label">Kategori CPL <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <select name="kategori" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Sikap">Sikap</option>
                                    <option value="Pengetahuan">Pengetahuan</option>
                                    <option value="Keterampilan Umum">Keterampilan Umum</option>
                                    <option value="Keterampilan Khusus">Keterampilan Khusus</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="input-group mb-4">
                                <select name="status" class="form-control" required>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>

                            <!-- Button -->
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100">
                                    <i class="fas fa-save me-2"></i>Simpan CPL
                                </button>
                                <a href="<?= base_url('master/cpl') ?>" class="btn btn-light w-100 mt-2">
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
