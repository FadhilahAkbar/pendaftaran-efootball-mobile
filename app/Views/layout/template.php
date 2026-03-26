<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <title>eFootball Tourney</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
</head>
<body>

    <div class="container mt-4">
        <?= $this->renderSection('content'); ?>
    </div>

    <div class="bottom-nav">
        <a href="<?= base_url('/'); ?>"><i class="fas fa-home"></i>Beranda</a>

        <?php if(session()->get('logged_in') == true): ?>
            
            <a href="<?= base_url('/tim-saya'); ?>" class="text-warning">
                <i class="fas fa-users"></i>Tim Saya
            </a>
            
            <a href="<?= base_url('/logout'); ?>" class="text-danger">
                <i class="fas fa-sign-out-alt"></i>Keluar
            </a>
            
        <?php else: ?>
            
            <a href="<?= base_url('/login'); ?>">
                <i class="fas fa-sign-in-alt"></i>Login
            </a>
            
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>