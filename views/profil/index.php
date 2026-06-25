<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Mon profil</h1>
            <p>Modifiez vos informations personnelles et votre mot de passe.</p>
        </section>

        <?= displayFlash(); ?>

        <section class="content-grid">
            <div class="card">
                <div class="card-header">
                    <h2>Informations personnelles</h2>
                </div>

                <form action="<?= url('/profil/update') ?>" method="POST">
                    <?= csrfField(); ?>

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?= e($profil['nom'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" value="<?= e($profil['email'] ?? '') ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre a jour</button>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Changer le mot de passe</h2>
                </div>

                <form action="<?= url('/profil/password') ?>" method="POST">
                    <?= csrfField(); ?>

                    <div class="form-group">
                        <label for="mot_de_passe_actuel">Mot de passe actuel</label>
                        <input type="password" id="mot_de_passe_actuel" name="mot_de_passe_actuel" required>
                    </div>

                    <div class="form-group">
                        <label for="nouveau_mot_de_passe">Nouveau mot de passe</label>
                        <input type="password" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" required minlength="8">
                    </div>

                    <div class="form-group">
                        <label for="confirmation_nouveau_mot_de_passe">Confirmation</label>
                        <input type="password" id="confirmation_nouveau_mot_de_passe" name="confirmation_nouveau_mot_de_passe" required minlength="8">
                    </div>

                    <button type="submit" class="btn btn-primary">Modifier le mot de passe</button>
                </form>
            </div>
        </section>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
