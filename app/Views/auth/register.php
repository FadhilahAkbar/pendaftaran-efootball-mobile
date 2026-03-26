<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card bg-dark text-white border-secondary shadow mt-4">
    <div class="card-body">
        <h4 class="card-title text-center mb-4 fw-bold">Daftar Akun Pemain</h4>
        
        <?php if(session()->has('errors')): ?>
            <div class="alert alert-danger small py-2">
                <ul class="mb-0 ps-3">
                    <?php foreach(session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form action="<?= base_url('/register/process'); ?>" method="POST">
            <div class="mb-3">
                <label class="form-label text-light opacity-75">Nama Lengkap</label>
                <input type="text" class="form-control bg-dark text-white border-secondary" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-light opacity-75">Email</label>
                <input type="email" class="form-control bg-dark text-white border-secondary" name="email" required>
            </div>
            <div class="mb-4">
                <label class="form-label text-light opacity-75">Password</label>
                <input type="password" class="form-control bg-dark text-white border-secondary" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Daftar Sekarang</button>
        </form>
        
        <p class="text-center mt-3 mb-0 small text-light opacity-75">
            Sudah punya akun? <a href="<?= base_url('/login'); ?>" class="text-warning text-decoration-none">Login di sini</a>
        </p>
    </div>
</div>

<?= $this->endSection(); ?>