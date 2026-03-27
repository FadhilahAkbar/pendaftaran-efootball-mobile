<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card bg-dark text-white border-secondary shadow">
    <div class="card-header bg-primary border-secondary">
        <h5 class="card-title mb-0 fw-bold">Edit Turnamen</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('/admin/update/' . $turnamen['id']); ?>" method="POST">
            <div class="mb-3">
                <label class="form-label text-light opacity-75">Nama Turnamen</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" name="name" value="<?= esc($turnamen['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-light opacity-75">Deskripsi</label>
                <textarea class="form-control bg-dark text-white border-secondary" name="description" rows="3" required><?= esc($turnamen['description']); ?></textarea>
            </div>
            <div class="mb-4">
                <label class="form-label text-light opacity-75">Status</label>
                <select name="status" class="form-select bg-dark text-white border-secondary">
                    <option value="open" <?= $turnamen['status'] == 'open' ? 'selected' : ''; ?>>DIBUKA</option>
                    <option value="ongoing" <?= $turnamen['status'] == 'ongoing' ? 'selected' : ''; ?>>BERJALAN</option>
                    <option value="completed" <?= $turnamen['status'] == 'completed' ? 'selected' : ''; ?>>SELESAI</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100 fw-bold mb-2">Simpan Perubahan</button>
            <a href="<?= base_url('/'); ?>" class="btn btn-outline-light w-100">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>