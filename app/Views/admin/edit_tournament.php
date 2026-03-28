<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6"> <div class="card bg-black text-white border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="bg-gradient bg-warning" style="height: 4px; width: 100%;"></div>
                
                <div class="card-body p-4 p-sm-5">
                    
                    <div class="text-center mb-4">
                        <div class="d-inline-block bg-dark p-3 rounded-circle mb-3 border border-secondary shadow-sm">
                            <i class="fas fa-edit fa-2x text-warning"></i>
                        </div>
                        <h4 class="card-title fw-bolder text-uppercase mb-1" style="letter-spacing: 1px;">Edit <span class="text-warning">Turnamen</span></h4>
                        <p class="text-light opacity-50 small">Sesuaikan detail turnamen eFootball kamu</p>
                    </div>
                    
                    <form action="<?= base_url('/admin/update/' . $turnamen['id']); ?>" method="POST">
                        <?= csrf_field(); ?> <div class="mb-4">
                            <label class="form-label text-light opacity-75 small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Nama Turnamen</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fas fa-trophy"></i></span>
                                <input type="text" class="form-control bg-dark text-white border-secondary" name="name" value="<?= esc($turnamen['name']); ?>" placeholder="Contoh: eFootball Championship 2024" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-light opacity-75 small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Deskripsi Singkat</label>
                            <textarea class="form-control bg-dark text-white border-secondary rounded-3" name="description" rows="3" placeholder="Tuliskan detail, hadiah, atau aturan turnamen..." required><?= esc($turnamen['description']); ?></textarea>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <label class="form-label text-light opacity-75 small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Maksimal Slot / Akun</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fas fa-users-cog"></i></span>
                                    <input type="number" class="form-control bg-dark text-white border-secondary" name="max_slots" value="<?= esc($turnamen['max_slots'] ?? '1'); ?>" min="1" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-light opacity-75 small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Status</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fas fa-toggle-on"></i></span>
                                    <select name="status" class="form-select bg-dark text-white border-secondary fw-bold">
                                        <option value="open" class="text-success" <?= $turnamen['status'] == 'open' ? 'selected' : ''; ?>>DIBUKA</option>
                                        <option value="ongoing" class="text-warning" <?= $turnamen['status'] == 'ongoing' ? 'selected' : ''; ?>>BERJALAN</option>
                                        <option value="completed" class="text-danger" <?= $turnamen['status'] == 'completed' ? 'selected' : ''; ?>>SELESAI</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning bg-gradient w-100 fw-bold py-3 rounded-pill shadow mb-4 text-dark text-uppercase" style="letter-spacing: 1px;">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </form>

                    <div class="text-center">
                        <a href="<?= base_url('/'); ?>" class="text-light text-decoration-none opacity-50 small">
                            <i class="fas fa-times me-1"></i> Batal & Kembali
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?= $this->endSection(); ?>