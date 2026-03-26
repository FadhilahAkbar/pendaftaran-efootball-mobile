<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<a href="<?= base_url('/'); ?>" class="btn btn-sm btn-outline-light mb-3">
    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
</a>

<div class="card bg-dark text-white border-secondary mb-4 shadow-sm">
    <div class="card-body p-3 d-flex justify-content-between align-items-center">
        <div>
            <small class="text-light opacity-75">Status Saat Ini:</small><br>
            <span class="badge bg-<?= $turnamen['status'] == 'open' ? 'success' : ($turnamen['status'] == 'ongoing' ? 'warning text-dark' : 'danger') ?>">
                <?= strtoupper($turnamen['status']); ?>
            </span>
        </div>
        <form action="<?= base_url('/admin/turnamen/update-status/' . $turnamen['id']); ?>" method="POST" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm bg-dark text-white border-secondary">
                <option value="open" <?= $turnamen['status'] == 'open' ? 'selected' : '' ?>>BUKA</option>
                <option value="ongoing" <?= $turnamen['status'] == 'ongoing' ? 'selected' : '' ?>>BERJALAN</option>
                <option value="completed" <?= $turnamen['status'] == 'completed' ? 'selected' : '' ?>>SELESAI</option>
            </select>
            <button type="submit" class="btn btn-sm btn-primary fw-bold">Simpan</button>
        </form>
    </div>
</div>
<div class="alert bg-primary text-white border-0 shadow-sm mb-4">

<div class="alert bg-primary text-white border-0 shadow-sm mb-4">
    <small class="d-block text-warning mb-1">Daftar Pendaftar Turnamen:</small>
    <h5 class="fw-bold mb-0"><?= esc($turnamen['name']); ?></h5>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success small py-2 border-0 shadow-sm">
        <i class="fas fa-check-circle me-1"></i> <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if(empty($teams)): ?>
    <div class="alert border-secondary text-center text-light opacity-75 mt-4">
        Belum ada tim yang mendaftar di turnamen ini.
    </div>
<?php else: ?>
    <?php foreach($teams as $tim): ?>
        <div class="card bg-dark text-white mb-3 border-secondary shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title fw-bold text-warning mb-0"><?= esc($tim['team_name']); ?></h5>
                    
                    <?php if($tim['status'] == 'pending'): ?>
                        <span class="badge bg-secondary">Menunggu</span>
                    <?php elseif($tim['status'] == 'approved'): ?>
                        <span class="badge bg-success">Disetujui</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Ditolak</span>
                    <?php endif; ?>
                </div>

                <p class="card-text small mb-1 text-light opacity-75">
                    <i class="fas fa-user me-2"></i><?= esc($tim['player_name']); ?>
                </p>
               
                <?php if($tim['status'] == 'pending'): ?>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('/admin/tim/status/' . $tim['id'] . '/approved'); ?>" class="btn btn-sm btn-success flex-fill fw-bold">
                            <i class="fas fa-check me-1"></i> Terima
                        </a>
                        <a href="<?= base_url('/admin/tim/status/' . $tim['id'] . '/rejected'); ?>" class="btn btn-sm btn-danger flex-fill fw-bold">
                            <i class="fas fa-times me-1"></i> Tolak
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection(); ?>