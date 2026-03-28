<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-secondary shadow-lg">
                <div class="card-header border-secondary bg-primary py-3">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Turnamen Baru
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="<?= base_url('/admin/store'); ?>" method="POST">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label for="name" class="form-label text-light opacity-75 fw-bold">Nama Turnamen</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="name" name="name" placeholder="Contoh: eFootball Ramadan Cup" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label text-light opacity-75 fw-bold">Deskripsi / Aturan Singkat</label>
                            <textarea class="form-control bg-dark text-white border-secondary" id="description" name="description" rows="3" placeholder="Contoh: Kuota 32 Slot, Sistem Gugur..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="max_slots" class="form-label text-light opacity-75 fw-bold">Maksimal Slot per Akun</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-secondary text-white">
                                    <i class="fas fa-users"></i>
                                </span>
                                <input type="number" id="max_slots" name="max_slots" class="form-control bg-dark text-white border-secondary" value="<?= isset($turnamen) ? $turnamen['max_slots'] : 1 ?>" min="1" required>
                            </div>
                            <div class="form-text text-info small mt-1">
                                <i class="fas fa-info-circle me-1"></i> Contoh: Isi 4 jika satu akun boleh mendaftarkan 4 tim berbeda.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label text-light opacity-75 fw-bold">Status Pendaftaran</label>
                            <select class="form-select bg-dark text-white border-secondary" id="status" name="status" required>
                                <option value="open" selected>Buka Pendaftaran (Open)</option>
                                <option value="ongoing">Sedang Berjalan (Tutup Pendaftaran)</option>
                                <option value="completed">Selesai (Completed)</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success fw-bold py-2">
                                <i class="fas fa-save me-2"></i>Simpan Turnamen
                            </button>
                            <a href="<?= base_url('/'); ?>" class="btn btn-outline-light py-2">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>