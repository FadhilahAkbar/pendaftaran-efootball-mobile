<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card bg-dark text-white border-secondary shadow">
    <div class="card-header border-secondary bg-primary">
        <h5 class="card-title mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i>Tambah Turnamen Baru</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('/admin/store'); ?>" method="POST">
            
            <div class="mb-3">
                <label for="name" class="form-label text-light opacity-75">Nama Turnamen</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" id="name" name="name" placeholder="Contoh: eFootball Ramadan Cup" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-light opacity-75">Deskripsi / Aturan Singkat</label>
                <textarea class="form-control bg-dark text-white border-secondary" id="description" name="description" rows="3" placeholder="Contoh: Kuota 32 Slot, Sistem Gugur..." required></textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label text-light opacity-75">Status Pendaftaran</label>
                <select class="form-select bg-dark text-white border-secondary" id="status" name="status" required>
                    <option value="open">Buka Pendaftaran</option>
                    <option value="ongoing">Sedang Berjalan (Tutup Pendaftaran)</option>
                    <option value="completed">Selesai</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100 fw-bold py-2">
                <i class="fas fa-save me-2"></i>Simpan Turnamen
            </button>
            <a href="<?= base_url('/'); ?>" class="btn btn-outline-light w-100 mt-2">Batal</a>
            
        </form>
    </div>
</div>

<?= $this->endSection(); ?>