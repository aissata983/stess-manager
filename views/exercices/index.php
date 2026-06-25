<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Exercices de respiration</h1>
            <p>Choisissez un exercice pour vous recentrer et diminuer votre stress.</p>
        </section>

        <?= displayFlash(); ?>

        <div class="cards-grid">
            <?php foreach ($exercices as $exercice): ?>
                <article class="exercise-card">
                    <div class="exercise-card-top" style="background: <?= e($exercice['couleur']) ?>;">
                        <i class="fas fa-wind"></i>
                    </div>

                    <div class="exercise-card-body">
                        <h2><?= e($exercice['titre']) ?></h2>
                        <p><?= e($exercice['description']) ?></p>

                        <div class="exercise-meta">
                            <span><i class="fas fa-clock"></i> <?= e(formatDuration((int) $exercice['duree_secondes'])) ?></span>
                            <span><i class="fas fa-signal"></i> <?= e(ucfirst($exercice['difficulte'])) ?></span>
                        </div>

                        <a href="<?= url('/exercices/' . $exercice['slug']) ?>" class="btn btn-primary btn-full">
                            Commencer
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
