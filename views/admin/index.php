<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Administration</h1>
            <p>Vue d'ensemble globale de l'application.</p>
        </section>

        <?= displayFlash(); ?>

        <section class="stats-grid">
            <article class="stat-card">
                <h3>Utilisateurs</h3>
                <p class="stat-value"><?= (int) ($userStats['total_utilisateurs'] ?? 0) ?></p>
            </article>

            <article class="stat-card">
                <h3>Administrateurs</h3>
                <p class="stat-value"><?= (int) ($userStats['total_admins'] ?? 0) ?></p>
            </article>

            <article class="stat-card">
                <h3>Emotions</h3>
                <p class="stat-value"><?= !empty($emotionStats) ? array_sum(array_map(fn($item) => (int) $item['nombre'], $emotionStats)) : 0 ?></p>
            </article>

            <article class="stat-card">
                <h3>Exercices realises</h3>
                <p class="stat-value"><?= (int) ($exerciseStats['total_realises'] ?? 0) ?></p>
            </article>

            <article class="stat-card">
                <h3>Meditations realisees</h3>
                <p class="stat-value"><?= (int) ($meditationStats['total_realisees'] ?? 0) ?></p>
            </article>
        </section>

        <section class="quick-actions">
            <a href="<?= url('/admin/users') ?>" class="action-card">
                <i class="fas fa-users"></i>
                <span>Voir les utilisateurs</span>
            </a>

            <a href="<?= url('/admin/statistiques') ?>" class="action-card">
                <i class="fas fa-chart-bar"></i>
                <span>Statistiques globales</span>
            </a>
        </section>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
