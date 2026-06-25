<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Ajouter une emotion</h1>
            <p>Notez votre ressenti du moment.</p>
        </section>

        <?= displayFlash(); ?>

        <div class="card form-card">
            <form action="<?= url('/emotions/store') ?>" method="POST">
                <?= csrfField(); ?>

                <div class="form-group">
                    <label for="humeur">Humeur</label>
                    <select name="humeur" id="humeur" required>
                        <option value="">Choisir une humeur</option>
                        <option value="tres_heureux">Tres heureux</option>
                        <option value="heureux">Heureux</option>
                        <option value="neutre">Neutre</option>
                        <option value="stresse">Stresse</option>
                        <option value="tres_stresse">Tres stresse</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="niveau_stress">Niveau de stress (1 a 10)</label>
                    <input type="number" name="niveau_stress" id="niveau_stress" min="1" max="10">
                </div>

                <div class="form-group">
                    <label for="commentaire">Commentaire facultatif</label>
                    <textarea name="commentaire" id="commentaire" rows="5" placeholder="Comment vous sentez-vous aujourd'hui ?"></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-floppy-disk"></i>
                        Enregistrer
                    </button>

                    <a href="<?= url('/emotions') ?>" class="btn btn-outline">Retour</a>
                </div>
            </form>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
