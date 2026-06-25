<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Historique des emotions</h1>
            <p>Retrouvez l'ensemble de vos enregistrements emotionnels.</p>
        </section>

        <div class="card">
            <?php if (!empty($emotions)): ?>
                <div class="timeline">
                    <?php foreach ($emotions as $emotion): ?>
                        <div class="timeline-item">
                            <div class="timeline-dot" style="background-color: <?= e(getMoodColor($emotion['humeur'])) ?>"></div>
                            <div class="timeline-content">
                                <h3><?= e(getMoodLabel($emotion['humeur'])) ?> <?= e(getMoodIcon($emotion['humeur'])) ?></h3>
                                <p><?= e($emotion['commentaire'] ?? 'Aucun commentaire') ?></p>
                                <small>
                                    <?= e(formatDate($emotion['date_enregistrement'], 'd/m/Y H:i')) ?>
                                    <?php if (!empty($emotion['niveau_stress'])): ?>
                                        - Stress : <?= (int) $emotion['niveau_stress'] ?>/10
                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="empty-state">Aucun historique disponible.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
