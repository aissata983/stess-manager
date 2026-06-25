<?php require VIEWS_PATH . 'layouts/header.php'; ?>

<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Inscription</h1>
            <p>Creez votre compte pour commencer votre suivi emotionnel.</p>
        </div>

        <?= displayFlash(); ?>

        <form action="<?= url('/register') ?>" method="POST" class="auth-form" id="registerForm">
            <?= csrfField(); ?>

            <div class="form-group">
                <label for="nom">Nom complet</label>
                <input type="text" id="nom" name="nom" required minlength="2" autocomplete="name">
            </div>

            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required minlength="8" autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="confirmation_mot_de_passe">Confirmation du mot de passe</label>
                <input type="password" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" required minlength="8" autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-user-check"></i>
                Creer mon compte
            </button>
        </form>

        <div class="auth-footer">
            <p>Vous avez deja un compte ? <a href="<?= url('/login') ?>">Connexion</a></p>
        </div>
    </div>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
