<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Meditation guidee</h1>
            <p>Prenez un moment pour ralentir, respirer et vous recentrer.</p>
        </section>

        <div class="cards-grid">
            <?php foreach ($meditations as $meditation): ?>
                <article class="exercise-card">
                    <div class="exercise-card-top meditation-gradient">
                        <i class="fas fa-brain"></i>
                    </div>

                    <div class="exercise-card-body">
                        <h2><?= e($meditation['titre']) ?></h2>
                        <p><?= e($meditation['description']) ?></p>

                        <div class="exercise-meta">
                            <span><i class="fas fa-clock"></i> <?= (int) $meditation['duree_minutes'] ?> min</span>
                            <span><i class="fas fa-layer-group"></i> <?= e(ucfirst($meditation['niveau'])) ?></span>
                        </div>

                        <a href="<?= url('/meditation/' . $meditation['slug']) ?>" class="btn btn-primary btn-full">
                            Lancer la seance
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
