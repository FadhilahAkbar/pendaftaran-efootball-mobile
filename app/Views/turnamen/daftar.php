<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert bg-danger text-white alert-dismissible fade show py-3 border-0 shadow-sm mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2 fs-5 align-middle"></i> 
                    <span class="align-middle fw-bold"><?= session()->getFlashdata('error'); ?></span>
                    <button type="button" class="btn-close btn-close-white px-2 py-3" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card bg-dark text-white border-secondary shadow-lg">
                <div class="card-header bg-primary border-secondary py-3">
                    <h5 class="card-title mb-0 fw-bold text-center">
                        <i class="fas fa-edit me-2"></i>Form Pendaftaran Turnamen
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    
                    <div class="alert alert-secondary bg-transparent border-secondary text-light mb-4 text-center shadow-sm">
                        <small class="d-block text-warning mb-1"><i class="fas fa-trophy me-1"></i> Mendaftar ke Turnamen:</small>
                        <h5 class="fw-bold mb-0 text-white"><?= esc($turnamen['name']); ?></h5>
                    </div>

                    <form action="<?= base_url('/turnamen/simpan'); ?>" method="POST">
                        <?= csrf_field(); ?>
                        
                        <input type="hidden" name="tournament_id" value="<?= $turnamen['id']; ?>">

                        <div class="mb-4">
                            <label for="team_name" class="form-label text-light opacity-75 fw-bold">Nama Tim / Squad Kamu</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-secondary border-secondary text-white"><i class="fas fa-shield-alt"></i></span>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="team_name" name="team_name" placeholder="Contoh: Garuda eSports" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="in_game_name" class="form-label text-light opacity-75 fw-bold">Nickname eFootball (IGN)</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-secondary border-secondary text-white"><i class="fas fa-gamepad"></i></span>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="in_game_name" name="in_game_name" placeholder="Contoh: Budi_Gaming99" required>
                            </div>
                            <div class="form-text text-info small mt-1">
                                <i class="fas fa-info-circle me-1"></i>Pastikan nickname sama persis dengan yang ada di dalam game.
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="in_game_id" class="form-label text-light opacity-75 fw-bold">ID Pemilik Akun eFootball</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-secondary border-secondary text-white"><i class="fas fa-id-badge"></i></span>
                                <input type="number" class="form-control bg-dark text-white border-secondary" id="in_game_id" name="in_game_id" placeholder="Contoh: 123456789" required>
                            </div>
                            <div class="form-text text-info small mt-1">
                                <i class="fas fa-info-circle me-1"></i>ID berupa angka yang digunakan untuk saling Add Friend.
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success fw-bold py-2 shadow-sm">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran
                            </button>
                            <a href="<?= base_url('/'); ?>" class="btn btn-outline-light py-2 shadow-sm">
                                <i class="fas fa-arrow-left me-2"></i>Batal & Kembali
                            </a>
                        </div>
                        
                    </form>

                </div>
            </div>
            
        </div>
    </div>
</div>

<?= $this->endSection(); ?>