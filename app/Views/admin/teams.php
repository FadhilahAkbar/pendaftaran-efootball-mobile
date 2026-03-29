<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-secondary pb-3 mt-2">
        <h4 class="fw-bolder text-white text-uppercase mb-0" style="letter-spacing: 1px; font-size: 1.2rem;">
            <i class="fas fa-users-cog text-primary me-2"></i>Kelola <span class="text-primary">Pendaftar</span>
        </h4>
        <a href="<?= base_url('/'); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3 shadow-sm fw-bold">
            <i class="fas fa-arrow-left me-1"></i> <span class="d-none d-sm-inline">Kembali</span>
        </a>
    </div>

    <div class="alert bg-dark border border-secondary text-light mb-4 p-3 rounded-3 shadow-sm d-flex align-items-center">
        <i class="fas fa-trophy fa-2x text-warning me-3"></i>
        <div>
            <small class="d-block text-warning fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">TURNAMEN:</small>
            <h5 class="fw-bold mb-0 text-white text-uppercase" style="letter-spacing: 0.5px; font-size: 1rem;"><?= esc($turnamen['name']); ?></h5>
        </div>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert bg-success text-white alert-dismissible fade show py-3 border-0 shadow-sm rounded-4 mb-4" role="alert">
            <i class="fas fa-check-circle me-2 fs-5 align-middle"></i> 
            <span class="align-middle fw-bold"><?= session()->getFlashdata('success'); ?></span>
            <button type="button" class="btn-close btn-close-white px-2 py-3" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card bg-black text-white border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="bg-gradient bg-primary" style="height: 4px; width: 100%;"></div>
        
        <div class="card-body p-0 table-responsive">
            <table class="table table-dark table-hover align-middle mb-0 text-nowrap" style="border-collapse: separate; border-spacing: 0;">
                
                <thead class="bg-dark text-light" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                    <tr class="text-center text-uppercase">
                        <th width="5%" class="py-3 border-bottom border-secondary">No</th>
                        <th class="py-3 border-bottom border-secondary text-start">Nama Tim</th>
                        <th class="py-3 border-bottom border-secondary text-start">Akun Pendaftar</th>
                        <th class="py-3 border-bottom border-secondary text-info"><i class="fas fa-gamepad me-1"></i> Nickname (IGN)</th> 
                        <th class="py-3 border-bottom border-secondary text-info"><i class="fas fa-id-badge me-1"></i> ID eFootball</th>  
                        <th class="py-3 border-bottom border-secondary">Status</th>
                        <th width="20%" class="py-3 border-bottom border-secondary">Aksi</th>
                    </tr>
                </thead>
                
                <tbody style="font-size: 0.95rem;">
                    <?php if(empty($teams)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fs-2 mb-3 d-block opacity-50"></i>
                                Belum ada tim yang mendaftar di turnamen ini.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach($teams as $t): ?>
                            <tr>
                                <td class="text-center text-secondary fw-bold border-bottom border-secondary py-3"><?= $no++; ?></td>
                                
                                <td class="fw-bolder text-warning text-uppercase border-bottom border-secondary text-start py-3" style="letter-spacing: 0.5px;">
                                    <?= esc($t['team_name']); ?>
                                </td>
                                
                                <td class="border-bottom border-secondary text-start py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-secondary bg-opacity-25 rounded-circle p-2 me-2">
                                            <i class="fas fa-user text-light"></i>
                                        </div>
                                        <?= esc($t['player_name']); ?>
                                    </div>
                                </td>
                                
                                <td class="text-info fw-bold text-center border-bottom border-secondary py-3"><?= esc($t['in_game_name'] ?? '-'); ?></td>
                                <td class="text-info font-monospace text-center border-bottom border-secondary py-3"><?= esc($t['in_game_id'] ?? '-'); ?></td>
                                
                                <td class="text-center border-bottom border-secondary py-3">
                                    <?php if($t['status'] == 'approved'): ?>
                                        <span class="badge bg-success bg-gradient px-3 py-2 rounded-pill shadow-sm"><i class="fas fa-check-circle me-1"></i> Disetujui</span>
                                    <?php elseif($t['status'] == 'rejected'): ?>
                                        <span class="badge bg-danger bg-gradient px-3 py-2 rounded-pill shadow-sm"><i class="fas fa-times-circle me-1"></i> Ditolak</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning bg-gradient text-dark px-3 py-2 rounded-pill shadow-sm"><i class="fas fa-clock me-1"></i> Menunggu</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="text-center border-bottom border-secondary py-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        <?php if($t['status'] == 'pending'): ?>
                                            <a href="<?= base_url('/admin/tim/status/' . $t['id'] . '/approved'); ?>" class="btn btn-sm btn-success rounded-pill fw-bold shadow-sm px-3" onclick="return confirm('Setujui tim ini?')"><i class="fas fa-check"></i> Terima</a>
                                            <a href="<?= base_url('/admin/tim/status/' . $t['id'] . '/rejected'); ?>" class="btn btn-sm btn-danger rounded-pill fw-bold shadow-sm px-3" onclick="return confirm('Tolak tim ini?')"><i class="fas fa-times"></i> Tolak</a>
                                        <?php elseif($t['status'] == 'approved'): ?>
                                            <a href="<?= base_url('/admin/tim/status/' . $t['id'] . '/rejected'); ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Ubah status menjadi Ditolak?')"><i class="fas fa-ban me-1"></i> Batalkan</a>
                                        <?php else: ?>
                                            <a href="<?= base_url('/admin/tim/status/' . $t['id'] . '/approved'); ?>" class="btn btn-sm btn-outline-success rounded-pill px-3" onclick="return confirm('Ubah status menjadi Disetujui?')"><i class="fas fa-undo me-1"></i> Terima Kembali</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>