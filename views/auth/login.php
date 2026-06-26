<?php require VIEWS_PATH . 'layouts/header.php'; ?>

<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="fas fa-heart-pulse"></i>
            </div>
            <h1>Connexion</h1>
            <p>Reconnectez-vous à votre espace de bien-être.</p>
        </div>

        <?= displayFlash(); ?>

        <form action="<?= url('/login') ?>" method="POST" class="auth-form" id="loginForm">
            <?= csrfField(); ?>

            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-right-to-bracket"></i>
                Se connecter
            </button>
        </form>

        <div class="auth-footer">
            <p>Pas encore de compte ? <a href="<?= url('/register') ?>">Inscription</a></p>
        </div>


    </div>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
