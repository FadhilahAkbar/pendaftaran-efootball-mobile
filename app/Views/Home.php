<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if(session()->get('logged_in')): ?>
    <div class="alert bg-black border border-secondary shadow-sm py-3 d-flex justify-content-between align-items-center mb-4 rounded-4">
        <div class="text-white">
            <i class="fas fa-user-circle text-primary fs-4 align-middle me-2"></i> 
            <span class="align-middle">Welcome player, <b class="text-warning"><?= esc(session()->get('user_name')); ?></b>!</span>
        </div>
        <?php if(session()->get('user_role') == 'admin'): ?>
            <a href="<?= base_url('/admin'); ?>" class="btn btn-sm btn-primary fw-bold px-3 py-2 rounded-pill shadow">
                <i class="fas fa-plus-circle me-1"></i> Buat Turnamen
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert bg-success text-white alert-dismissible fade show py-3 border-0 shadow-sm rounded-4" role="alert">
        <i class="fas fa-check-circle me-2 fs-5 align-middle"></i> 
        <span class="align-middle fw-bold"><?= session()->getFlashdata('success'); ?></span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert bg-danger text-white alert-dismissible fade show py-3 border-0 shadow-sm rounded-4" role="alert">
        <i class="fas fa-exclamation-circle me-2 fs-5 align-middle"></i> 
        <span class="align-middle fw-bold"><?= session()->getFlashdata('error'); ?></span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="d-flex align-items-end mb-4 border-bottom border-secondary pb-2 mt-2">
    <h4 class="fw-bolder text-white text-uppercase mb-0" style="letter-spacing: 1px;">
        <i class="text-primary me-2"></i>Daftar <span class="text-warning">Turnamen</span>
    </h4>
</div>

<?php if(empty($tournaments)): ?>
    <div class="alert bg-black border border-secondary text-center py-5 rounded-4 shadow-sm" role="alert">
        <i class="fas fa-ghost fs-1 mb-3 text-secondary"></i><br>
        <span class="text-light opacity-75">Belum ada turnamen yang tersedia saat ini.<br>Nantikan pertempuran selanjutnya!</span>
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach($tournaments as $t): ?>
            <div class="col-md-6 mb-4">
                <div class="card bg-black text-white border-0 shadow-lg rounded-4 overflow-hidden h-100 position-relative">
                    
                    <div class="bg-gradient bg-primary" style="height: 4px; width: 100%;"></div>

                    <div class="card-body p-4 d-flex flex-column">
                        
                        <div class="mb-3">
                            <?php if($t['status'] == 'open'): ?>
                                <span class="badge bg-success bg-gradient px-3 py-2 rounded-pill fw-bold text-uppercase"><i class="fas fa-door-open me-1"></i> Registration Open</span>
                            <?php elseif($t['status'] == 'ongoing'): ?>
                                <span class="badge bg-warning bg-gradient text-dark px-3 py-2 rounded-pill fw-bold text-uppercase"><i class="fas fa-play-circle me-1"></i> Match Ongoing</span>
                            <?php else: ?>
                                <span class="badge bg-danger bg-gradient px-3 py-2 rounded-pill fw-bold text-uppercase"><i class="fas fa-flag-checkered me-1"></i> Tournament Ended</span>
                            <?php endif; ?>
                        </div>

                        <h4 class="card-title fw-black text-warning text-uppercase mb-2" style="font-weight: 900;">
                            <?= esc($t['name']); ?>
                        </h4>
                        <p class="card-text text-light opacity-75 mb-4" style="font-size: 0.95rem;">
                            <?= esc($t['description']); ?>
                        </p>

                        <div class="mt-auto bg-dark p-3 rounded-3 border border-secondary mb-3">
                            <div class="d-flex align-items-center text-info small fw-bold">
                                <i class="fas fa-users-cog fs-5 me-3"></i>
                                <div>
                                    <span class="text-light opacity-75 d-block" style="font-size: 0.75rem;">BATAS PENDAFTARAN</span>
                                    <span><?= esc($t['max_slots'] ?? '1'); ?> Slot / Akun</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid mt-2">
                            <?php if($t['status'] == 'open'): ?>
                                <a href="<?= base_url('/turnamen/daftar/' . $t['id']); ?>" class="btn btn-primary bg-gradient rounded-pill fw-bold py-2 shadow">
                                    <i class="fas fa-paper-plane me-2"></i>Daftar Sekarang
                                </a>
                            <?php elseif($t['status'] == 'ongoing'): ?>
                                <a href="<?= base_url('/turnamen/bagan/' . $t['id']); ?>" class="btn btn-outline-warning rounded-pill fw-bold py-2">
                                    <i class="fas fa-sitemap me-2"></i>Lihat Bracket
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('/turnamen/bagan/' . $t['id']); ?>" class="btn btn-outline-danger rounded-pill fw-bold py-2">
                                    <i class="fas fa-trophy me-2"></i>Lihat Hasil Akhir
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if(session()->get('user_role') == 'admin'): ?>
                            <div class="mt-4 pt-3 border-top border-secondary">
                                <p class="text-muted small fw-bold mb-2"><i class="fas fa-shield-alt me-1"></i> Admin Controls</p>
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="<?= base_url('/admin/turnamen/' . $t['id'] . '/tim'); ?>" class="btn btn-sm btn-info bg-gradient text-dark fw-bold flex-grow-1">
                                        <i class="fas fa-users-cog me-1"></i>Pendaftar
                                    </a>
                                    <a href="<?= base_url('/admin/edit/' . $t['id']); ?>" class="btn btn-sm btn-warning text-dark fw-bold flex-grow-1">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <a href="<?= base_url('/admin/delete/' . $t['id']); ?>" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Yakin ingin menghapus turnamen ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div> 
                </div> 
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>