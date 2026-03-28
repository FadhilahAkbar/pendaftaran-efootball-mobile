<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <title>eFootball Tourney</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<body>

    <main class="pb-5 mb-5">
        <div class="container mt-4">
            <?= $this->renderSection('content'); ?>
        </div>
    </main>

    <nav class="bottom-nav">
        <?php 
            // Mengambil URL saat ini untuk mendeteksi menu mana yang sedang aktif
            $current_url = uri_string(); 
        ?>

        <a href="<?= base_url('/'); ?>" class="<?= ($current_url == '' || $current_url == '/') ? 'active text-primary' : ''; ?>">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </a>

        <?php if(session()->get('logged_in') == true): ?>
            
            <a href="<?= base_url('/tim-saya'); ?>" class="<?= (strpos($current_url, 'tim-saya') !== false) ? 'active text-warning' : 'text-secondary'; ?>">
                <i class="fas fa-users"></i>
                <span>Tim Saya</span>
            </a>
            
            <a href="<?= base_url('/logout'); ?>" class="text-secondary danger-hover">
                <i class="fas fa-sign-out-alt"></i>
                <span>Keluar</span>
            </a>
            
        <?php else: ?>
            
            <a href="<?= base_url('/login'); ?>" class="<?= (strpos($current_url, 'login') !== false || strpos($current_url, 'register') !== false) ? 'active text-primary' : 'text-secondary'; ?>">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login / Daftar</span>
            </a>
            
        <?php endif; ?>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>