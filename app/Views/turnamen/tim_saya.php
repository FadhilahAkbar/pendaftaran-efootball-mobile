<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<h4 class="mb-4 fw-bold"><i class="fas fa-users me-2"></i>Status Pendaftaran Saya</h4>

<?php if(empty($my_teams)): ?>
    <div class="alert alert-dark border-secondary text-center text-light opacity-75">
        <i class="fas fa-sad-tear fs-1 mb-2"></i><br>
        Kamu belum mendaftar di turnamen manapun.
    </div>
<?php else: ?>
    <?php foreach($my_teams as $tim): ?>
        <div class="card bg-dark text-white mb-3 border-secondary shadow-sm">
            <div class="card-body">
                <small class="text-warning d-block mb-1">Turnamen:</small>
                <h5 class="card-title fw-bold mb-3"><?= esc($tim['turnamen_name']); ?></h5>
                
                <div class="d-flex justify-content-between align-items-center p-2 bg-secondary bg-opacity-25 rounded border border-secondary">
                    <div>
                        <small class="d-block text-light opacity-75 mb-1">Nama Tim / Squad:</small>
                        <span class="fw-bold fs-6"><?= esc($tim['team_name']); ?></span>
                    </div>
                    
                    <div class="text-end">
                        <small class="d-block text-light opacity-75 mb-1">Status:</small>
                        <?php if($tim['status'] == 'pending'): ?>
                            <span class="badge bg-secondary px-2 py-1"><i class="fas fa-clock me-1"></i>Menunggu</span>
                        <?php elseif($tim['status'] == 'approved'): ?>
                            <span class="badge bg-success px-2 py-1"><i class="fas fa-check me-1"></i>Disetujui</span>
                        <?php else: ?>
                            <span class="badge bg-danger px-2 py-1"><i class="fas fa-times me-1"></i>Ditolak</span>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection(); ?>