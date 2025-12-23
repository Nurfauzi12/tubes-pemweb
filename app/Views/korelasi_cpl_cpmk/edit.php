<!-- Edit Modal Partial -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true" style="z-index: 999999;">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary text-gradient">Edit Korelasi CPL-CPMK</h3>
                    </div>
                    <div class="card-body pb-3">
                        <form action="" method="post" id="formEdit">
                            <input type="hidden" name="id" id="edit_id" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Penyusun</label>
                                    <div class="input-group mb-3">
                                        <select name="id_penyusun" id="edit_id_penyusun" class="form-control" required>
                                            <option value="">Pilih Penyusun</option>
                                            <?php foreach ($penyusun ?? [] as $p): ?>
                                                <option value="<?= esc($p['id']) ?>"><?= esc($p['pengembangan_rps']) ?> - <?= esc($p['koordinator_rumpun']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Mata Kuliah</label>
                                    <div class="input-group mb-3">
                                        <select name="id_matakuliah" id="edit_id_matakuliah" class="form-control" required>
                                            <option value="">Pilih Mata Kuliah</option>
                                            <?php foreach ($matakuliah ?? [] as $m): ?>
                                                <option value="<?= esc($m['id']) ?>"><?= esc($m['kode']) ?> - <?= esc($m['matakuliah']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>CPMK</label>
                                    <div class="input-group mb-3">
                                        <select name="id_cpmk" id="edit_id_cpmk" class="form-control" required>
                                            <option value="">Pilih CPMK</option>
                                            <?php foreach ($cpmk ?? [] as $c): ?>
                                                <option value="<?= esc($c['id']) ?>"><?= esc($c['cpmk']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Sub-CPMK</label>
                                    <div class="input-group mb-3">
                                        <select name="id_sub_cpmk" id="edit_id_sub_cpmk" class="form-control">
                                            <option value="">Pilih Sub CPMK</option>
                                            <?php foreach ($sub_cpmk ?? [] as $s): ?>
                                                <option value="<?= esc($s['id']) ?>"><?= esc($s['sub_cpmk']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Presentase (%)</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" id="edit_presentase" name="presentase" min="0" max="100" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Bobot Penilaian</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" id="edit_bobot_penilaian" name="bobot_penilaian" min="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
