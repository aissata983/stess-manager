<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Bonjour, <?= e($user['nom']) ?> 👋</h1>
            <p>Bienvenue sur votre espace de gestion du stress.</p>
        </section>

        <?= displayFlash(); ?>

        <section class="stats-grid">
            <article class="stat-card gradient-blue">
                <div class="stat-icon"><i class="fas fa-face-smile"></i></div>
                <div>
                    <h3>Derniere humeur</h3>
                    <p class="stat-value">
                        <?= $latestEmotion ? e(getMoodLabel($latestEmotion['humeur'])) : 'Aucune donnee' ?>
                    </p>
                </div>
            </article>

            <article class="stat-card gradient-green">
                <div class="stat-icon"><i class="fas fa-notes-medical"></i></div>
                <div>
                    <h3>Emotions enregistrees</h3>
                    <p class="stat-value"><?= (int) $emotionCount ?></p>
                </div>
            </article>

            <article class="stat-card gradient-purple">
                <div class="stat-icon"><i class="fas fa-wind"></i></div>
                <div>
                    <h3>Exercices effectues</h3>
                    <p class="stat-value"><?= (int) $exerciceCount ?></p>
                </div>
            </article>

            <article class="stat-card gradient-orange">
                <div class="stat-icon"><i class="fas fa-brain"></i></div>
                <div>
                    <h3>Meditations realisees</h3>
                    <p class="stat-value"><?= (int) $meditationCount ?></p>
                </div>
            </article>
        </section>

        <section class="content-grid">
            <div class="card">
                <div class="card-header">
                    <h2>Historique recent des emotions</h2>
                    <a href="<?= url('/emotions/history') ?>" class="btn btn-outline btn-sm">Voir tout</a>
                </div>

                <?php if (!empty($emotionHistory)): ?>
                    <div class="emotion-list">
                        <?php foreach ($emotionHistory as $emotion): ?>
                            <div class="emotion-item">
                                <div class="emotion-icon" style="background-color: <?= e(getMoodColor($emotion['humeur'])) ?>">
                                    <?= e(getMoodIcon($emotion['humeur'])) ?>
                                </div>
                                <div class="emotion-content">
                                    <strong><?= e(getMoodLabel($emotion['humeur'])) ?></strong>
                                    <p><?= e($emotion['commentaire'] ?? 'Aucun commentaire') ?></p>
                                    <small><?= e(formatDate($emotion['date_enregistrement'], 'd/m/Y H:i')) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="empty-state">Aucune emotion enregistree pour le moment.</p>
                <?php endif; ?>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Evolution recente du stress</h2>
                </div>

                <canvas
                    id="stressEvolutionChart"
                    data-labels='<?= e(json_encode(array_column($stressEvolution, 'jour'))) ?>'
                    data-values='<?= e(json_encode(array_map(fn($item) => round((float) $item['niveau_moyen'], 2), $stressEvolution))) ?>'
                ></canvas>
            </div>
        </section>

        <section class="quick-actions">
            <a href="<?= url('/emotions/create') ?>" class="action-card">
                <i class="fas fa-plus"></i>
                <span>Ajouter une emotion</span>
            </a>

            <a href="<?= url('/exercices') ?>" class="action-card">
                <i class="fas fa-wind"></i>
                <span>Lancer un exercice</span>
            </a>

            <a href="<?= url('/meditation') ?>" class="action-card">
                <i class="fas fa-brain"></i>
                <span>Commencer une meditation</span>
            </a>

            <a href="<?= url('/statistiques') ?>" class="action-card">
                <i class="fas fa-chart-column"></i>
                <span>Voir mes statistiques</span>
            </a>
        </section>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
