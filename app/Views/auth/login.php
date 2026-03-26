<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card bg-dark text-white border-secondary shadow mt-4">
    <div class="card-body">
        <h4 class="card-title text-center mb-4 fw-bold">Login eFootball</h4>
        
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger small py-2"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success small py-2"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/login/process'); ?>" method="POST">
            <div class="mb-3">
                <label class="form-label text-light opacity-75">Email</label>
                <input type="email" class="form-control bg-dark text-white border-secondary" name="email" required>
            </div>
            <div class="mb-4">
                <label class="form-label text-light opacity-75">Password</label>
                <input type="password" class="form-control bg-dark text-white border-secondary" name="password" required>
            </div>
            <button type="submit" class="btn btn-warning w-100 fw-bold py-2">Login</button>
        </form>

        <p class="text-center mt-3 mb-0 small text-light opacity-75">
            Belum punya akun? <a href="<?= base_url('/register'); ?>" class="text-primary text-decoration-none">Daftar di sini</a>
        </p>
    </div>
</div>

<?= $this->endSection(); ?>