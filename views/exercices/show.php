<?php
require VIEWS_PATH . 'layouts/header.php';
require VIEWS_PATH . 'layouts/navbar.php';

$params = json_decode($exercice['parametres'] ?? '{}', true) ?: [];
?>
<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1><?= e($exercice['titre']) ?></h1>
            <p><?= e($exercice['description']) ?></p>
        </section>

        <?= displayFlash(); ?>

        <div class="exercise-session">
            <div class="card">
                <div class="card-header">
                    <h2>Instructions</h2>
                </div>
                <div class="formatted-text">
                    <?= nl2br(e($exercice['instructions'])) ?>
                </div>
            </div>

            <div class="card breathing-card">
                <div
                    class="breathing-app"
                    data-exercice-id="<?= (int) $exercice['id'] ?>"
                    data-duration="<?= (int) $exercice['duree_secondes'] ?>"
                    data-inspire="<?= (int) ($params['inspire'] ?? 4) ?>"
                    data-hold-high="<?= (int) ($params['retention_haute'] ?? 0) ?>"
                    data-expire="<?= (int) ($params['expire'] ?? 4) ?>"
                    data-hold-low="<?= (int) ($params['retention_basse'] ?? 0) ?>"
                    data-cycles="<?= (int) ($params['cycles'] ?? 4) ?>"
                >
                    <div class="breathing-circle" id="breathingCircle">
                        <span id="breathingPhase">Pret</span>
                    </div>

                    <div class="breathing-timer" id="breathingTimer">
                        <?= e(formatDuration((int) $exercice['duree_secondes'])) ?>
                    </div>

                    <div class="breathing-controls">
                        <button type="button" class="btn btn-primary" id="startBreathingBtn">Demarrer</button>
                        <button type="button" class="btn btn-outline" id="resetBreathingBtn">Reinitialiser</button>
                    </div>

                    <form action="<?= url('/exercices/complete') ?>" method="POST" id="exerciseCompleteForm">
                        <?= csrfField(); ?>
                        <input type="hidden" name="exercice_id" value="<?= (int) $exercice['id'] ?>">
                        <input type="hidden" name="duree_reelle_secondes" id="duree_reelle_secondes" value="0">
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
