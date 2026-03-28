<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="fas fa-users-cog me-2"></i>Kelola Pendaftar: <?= esc($turnamen['name']); ?></h4>
    <a href="<?= base_url('/admin'); ?>" class="btn btn-outline-light btn-sm"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert bg-success text-white alert-dismissible fade show small py-2 border-0 shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close btn-close-white px-2 py-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card bg-dark text-white border-secondary shadow-sm">
    <div class="card-body p-0 table-responsive">
        <table class="table table-dark table-hover table-bordered mb-0 align-middle">
            <thead class="table-secondary text-dark text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Tim</th>
                    <th>Akun Pendaftar</th>
                    <th class="text-primary">Nickname (IGN)</th> <th class="text-primary">ID eFootball</th>   <th>Status</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($teams)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada tim yang mendaftar.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach($teams as $t): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="fw-bold text-warning"><?= esc($t['team_name']); ?></td>
                            <td><i class="fas fa-user-circle me-1"></i> <?= esc($t['player_name']); ?></td>
                            
                            <td class="text-info fw-bold"><?= esc($t['in_game_name'] ?? '-'); ?></td>
                            <td class="text-info font-monospace"><?= esc($t['in_game_id'] ?? '-'); ?></td>
                            
                            <td class="text-center">
                                <?php if($t['status'] == 'approved'): ?>
                                    <span class="badge bg-success"><i class="fas fa-check me-1"></i>Disetujui</span>
                                <?php elseif($t['status'] == 'rejected'): ?>
                                    <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Ditolak</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Menunggu</span>
                                <?php endif; ?>
                            </td>
                                <<td class="text-center">
                                <?php if($t['status'] == 'pending'): ?>
                                    <a href="<?= base_url('/admin/tim/status/' . $t['id'] . '/approved'); ?>" class="btn btn-sm btn-success fw-bold" onclick="return confirm('Setujui tim ini?')">Approve</a>
                                    <a href="<?= base_url('/admin/tim/status/' . $t['id'] . '/rejected'); ?>" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Tolak tim ini?')">Reject</a>
                                <?php elseif($t['status'] == 'approved'): ?>
                                    <a href="<?= base_url('/admin/tim/status/' . $t['id'] . '/rejected'); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Ubah status menjadi Ditolak?')">Batalkan</a>
                                <?php else: ?>
                                    <a href="<?= base_url('/admin/tim/status/' . $t['id'] . '/approved'); ?>" class="btn btn-sm btn-outline-success" onclick="return confirm('Ubah status menjadi Disetujui?')">Terima Kembali</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>