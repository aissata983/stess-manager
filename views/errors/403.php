<?php require VIEWS_PATH . 'layouts/header.php'; ?>

<div class="auth-page">
    <div class="auth-card text-center">
        <div class="auth-logo">
            <i class="fas fa-ban"></i>
        </div>
        <h1>403</h1>
        <p>Acces refuse.</p>
        <a href="<?= url('/dashboard') ?>" class="btn btn-primary">Retour au tableau de bord</a>
    </div>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
