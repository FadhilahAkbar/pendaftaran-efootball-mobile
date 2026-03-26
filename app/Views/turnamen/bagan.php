<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<a href="<?= base_url('/'); ?>" class="btn btn-sm btn-outline-light mb-3">
    <i class="fas fa-arrow-left me-2"></i>Kembali
</a>

<div class="text-center mb-4">
    <h4 class="fw-bold text-warning mb-1"><i class="fas fa-sitemap me-2"></i>PESERTA RESMI</h4>
    <h6 class="text-light opacity-75"><?= esc($turnamen['name']); ?></h6>
</div>

<?php if($turnamen['status'] == 'completed'): ?>
    <div class="alert bg-danger border-warning text-white text-center shadow-sm mb-4">
        <h5 class="fw-bold mb-0 text-warning"><i class="fas fa-trophy me-2"></i>TURNAMEN TELAH SELESAI</h5>
        <small class="opacity-75">Terima kasih kepada semua peserta yang telah bertanding!</small>
    </div>
<?php endif; ?>

<?php if(empty($approved_teams)): ?>
    <div class="alert alert-dark border-secondary text-center text-light opacity-75">
        Belum ada tim yang disetujui untuk bertanding.
    </div>
<?php else: ?>
    <div class="row g-2">
        <?php $no = 1; foreach($approved_teams as $tim): ?>
            <div class="col-6">
                <div class="card bg-dark border-secondary h-100 shadow-sm">
                    <div class="card-body p-2 text-center d-flex flex-column justify-content-center">
                        <span class="badge bg-secondary mb-2 mx-auto">Slot <?= $no++; ?></span>
                        <h6 class="card-title text-white mb-0 text-truncate" style="font-size: 0.85rem;">
                            <?= esc($tim['team_name']); ?>
                        </h6>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>