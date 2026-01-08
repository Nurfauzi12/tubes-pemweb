<?= $this->extend('layout/admin/layout') ?>
<?= $this->section('content') ?>

<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-white" href="javascript:;">Master Data</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                        CPL
                    </li>
                </ol>
                <h3 class="font-weight-bolder text-white mb-0">
                    Master Data CPL
                </h3>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">

                    <div class="card-header pb-0">
                        <h5>Capaian Pembelajaran Lulusan (CPL)</h5>
                        <h6 class="text-sm">
                            Daftar CPL yang menjadi acuan pembelajaran dan evaluasi lulusan
                        </h6>

                        <!-- Flash Message -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show mt-3">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <!-- Button Tambah -->
                        <button type="button"
                                class="btn bg-gradient-success btn-block mt-3 mb-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalCreate">
                            <i class="fas fa-plus me-2"></i>Tambah CPL
                        </button>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-hover align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                            No
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-4">
                                            Kode CPL
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                            Deskripsi CPL
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                            Kategori
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                            Status
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($cpl)): ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <p class="text-sm text-secondary mb-0">
                                                    Tidak ada data CPL
                                                </p>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $no = 1; foreach ($cpl as $item): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <p class="mb-0 text-sm"><?= $no++; ?></p>
                                                </td>
                                                <td class="ps-4">
                                                    <h6 class="mb-0 text-sm">
                                                        <?= esc($item['kode_cpl']) ?>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <p class="text-sm mb-0">
                                                        <?= esc($item['deskripsi']) ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm mb-0">
                                                        <?= esc($item['kategori']) ?>
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-gradient-<?= $item['status'] === 'Aktif' ? 'success' : 'secondary' ?>">
                                                        <?= esc($item['status']) ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm bg-gradient-info me-2">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-sm bg-gradient-danger">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>
