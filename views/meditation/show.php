<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1><?= e($meditation['titre']) ?></h1>
            <p><?= e($meditation['description']) ?></p>
        </section>

        <?= displayFlash(); ?>

        <div
            class="meditation-session"
            data-minutes="<?= (int) $meditation['duree_minutes'] ?>"
        >
            <div class="card meditation-player">
                <div class="meditation-timer" id="meditationTimer">
                    <?= sprintf('%02d:00', (int) $meditation['duree_minutes']) ?>
                </div>

                <div class="meditation-controls">
                    <button type="button" class="btn btn-primary" id="startMeditationBtn">Demarrer</button>
                    <button type="button" class="btn btn-outline" id="resetMeditationBtn">Reinitialiser</button>
                </div>

                <form action="<?= url('/meditation/complete') ?>" method="POST" id="meditationCompleteForm">
                    <?= csrfField(); ?>
                    <input type="hidden" name="meditation_id" value="<?= (int) $meditation['id'] ?>">
                    <input type="hidden" name="duree_reelle_minutes" id="duree_reelle_minutes" value="0">
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Texte guide</h2>
                </div>
                <div class="formatted-text meditation-text">
                    <?= nl2br(e($meditation['contenu_guide'])) ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
