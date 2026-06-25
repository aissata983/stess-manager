<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Suivi emotionnel</h1>
            <p>Consultez et enregistrez vos emotions quotidiennes.</p>
        </section>

        <?= displayFlash(); ?>

        <div class="page-actions">
            <a href="<?= url('/emotions/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Ajouter une emotion
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Mes emotions</h2>
            </div>

            <?php if (!empty($emotions)): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Humeur</th>
                                <th>Niveau de stress</th>
                                <th>Commentaire</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($emotions as $emotion): ?>
                                <tr>
                                    <td>
                                        <span class="badge-mood" style="background-color: <?= e(getMoodColor($emotion['humeur'])) ?>">
                                            <?= e(getMoodIcon($emotion['humeur'])) ?> <?= e(getMoodLabel($emotion['humeur'])) ?>
                                        </span>
                                    </td>
                                    <td><?= $emotion['niveau_stress'] ? (int) $emotion['niveau_stress'] . '/10' : '-' ?></td>
                                    <td><?= e($emotion['commentaire'] ?? '-') ?></td>
                                    <td><?= e(formatDate($emotion['date_enregistrement'], 'd/m/Y H:i')) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="empty-state">Aucune emotion enregistree.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
