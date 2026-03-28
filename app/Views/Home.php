<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if(session()->get('logged_in')): ?>
    <div class="alert bg-success text-white border-0 shadow-sm py-2 d-flex justify-content-between align-items-center mb-3">
        <div>
            <i class="fas fa-user-circle me-2"></i> Halo, <b><?= esc(session()->get('user_name')); ?></b>!
        </div>
        <?php if(session()->get('user_role') == 'admin'): ?>
            <a href="<?= base_url('/admin'); ?>" class="btn btn-sm btn-light fw-bold px-2 py-0 text-dark">
                <i class="fas fa-plus-circle me-1"></i> Tambah Turnamen
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert bg-success text-white alert-dismissible fade show small py-2 border-0 shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close btn-close-white px-2 py-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert bg-danger text-white alert-dismissible fade show small py-2 border-0 shadow-sm" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close btn-close-white px-2 py-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<h4 class="mb-4 fw-bold">Turnamen eFootball Mobile</h4>

<?php if(empty($tournaments)): ?>
    <div class="alert alert-dark border-secondary text-center" role="alert">
        <i class="fas fa-box-open fs-1 mb-2 text-muted"></i><br>
        Belum ada turnamen yang tersedia saat ini.
    </div>
<?php else: ?>
    <?php foreach($tournaments as $t): ?>
        <div class="card bg-dark text-white mb-3 border-secondary shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold text-warning mb-1"><?= esc($t['name']); ?></h5>
                
                <p class="card-text text-light opacity-75 small mb-2">
                    <?= esc($t['description']); ?>
                </p>

                <div class="mb-3">
                    <small class="text-info">
                        <i class="fas fa-users me-1"></i> 
                        Batas Pendaftaran: <b><?= esc($t['max_slots'] ?? '1'); ?> Slot</b> per akun
                    </small>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <?php if($t['status'] == 'open'): ?>
                        <span class="badge bg-success px-3 py-2">DIBUKA</span>
                        <a href="<?= base_url('/turnamen/daftar/' . $t['id']); ?>" class="btn btn-sm btn-primary px-3 rounded-pill fw-bold">Daftar</a>
                    <?php elseif($t['status'] == 'ongoing'): ?>
                        <span class="badge bg-warning text-dark px-3 py-2">BERJALAN</span>
                        <a href="<?= base_url('/turnamen/bagan/' . $t['id']); ?>" class="btn btn-sm btn-outline-light px-3 rounded-pill">Lihat Bagan</a>
                    <?php else: ?>
                        <span class="badge bg-danger px-3 py-2">SELESAI</span>
                        <a href="<?= base_url('/turnamen/bagan/' . $t['id']); ?>" class="btn btn-sm btn-outline-danger px-3 rounded-pill fw-bold">Hasil Akhir</a>
                    <?php endif; ?>
                </div>

                <?php if(session()->get('user_role') == 'admin'): ?>
                    <hr class="border-secondary mt-3 mb-2">
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('/admin/turnamen/' . $t['id'] . '/tim'); ?>" class="btn btn-sm btn-info text-dark fw-bold">
                            <i class="fas fa-users-cog me-2"></i>Kelola Pendaftar
                        </a>
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('/admin/edit/' . $t['id']); ?>" class="btn btn-sm btn-warning flex-fill fw-bold text-dark">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="<?= base_url('/admin/delete/' . $t['id']); ?>" class="btn btn-sm btn-danger flex-fill fw-bold" onclick="return confirm('Yakin ingin menghapus turnamen ini?')">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div> 
        </div> 
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection(); ?>