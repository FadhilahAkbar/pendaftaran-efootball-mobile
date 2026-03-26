<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card bg-dark text-white border-secondary shadow mt-4">
    <div class="card-header bg-primary border-secondary">
        <h5 class="card-title mb-0 fw-bold"><i class="fas fa-edit me-2"></i>Form Pendaftaran Turnamen</h5>
    </div>
    <div class="card-body">
        
        <div class="alert alert-secondary bg-transparent border-secondary text-light mb-4">
            <small class="d-block text-warning mb-1">Mendaftar ke:</small>
            <h5 class="fw-bold mb-0"><?= esc($turnamen['name']); ?></h5>
        </div>

        <form action="<?= base_url('/turnamen/simpan'); ?>" method="POST">
            
            <input type="hidden" name="tournament_id" value="<?= $turnamen['id']; ?>">

            <div class="mb-4">
                <label for="team_name" class="form-label text-light opacity-75">Nama Tim / Squad Kamu</label>
                <input type="text" class="form-control bg-dark text-white border-secondary form-control-lg" id="team_name" name="team_name" placeholder="Contoh: Garuda eSports" required>
            </div>

            <button type="submit" class="btn btn-success w-100 fw-bold py-2 mb-2">
                <i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran
            </button>
            <a href="<?= base_url('/'); ?>" class="btn btn-outline-light w-100">Batal</a>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>