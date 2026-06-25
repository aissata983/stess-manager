<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Statistiques globales</h1>
            <p>Indicateurs globaux de l'application.</p>
        </section>

        <section class="stats-grid">
            <article class="stat-card">
                <h3>Total utilisateurs</h3>
                <p class="stat-value"><?= (int) ($userStats['total_utilisateurs'] ?? 0) ?></p>
            </article>

            <article class="stat-card">
                <h3>Total admins</h3>
                <p class="stat-value"><?= (int) ($userStats['total_admins'] ?? 0) ?></p>
            </article>

            <article class="stat-card">
                <h3>Total utilisateurs standards</h3>
                <p class="stat-value"><?= (int) ($userStats['total_users'] ?? 0) ?></p>
            </article>

            <article class="stat-card">
                <h3>Total exercices realises</h3>
                <p class="stat-value"><?= (int) ($exerciseStats['total_realises'] ?? 0) ?></p>
            </article>

            <article class="stat-card">
                <h3>Total meditations realisees</h3>
                <p class="stat-value"><?= (int) ($meditationStats['total_realisees'] ?? 0) ?></p>
            </article>
        </section>

        <div class="card">
            <div class="card-header">
                <h2>Repartition globale des emotions</h2>
            </div>

            <canvas
                id="adminEmotionChart"
                data-labels='<?= e(json_encode(array_map(fn($item) => getMoodLabel($item["humeur"]), $emotionStats))) ?>'
                data-values='<?= e(json_encode(array_map(fn($item) => (int) $item["nombre"], $emotionStats))) ?>'
            ></canvas>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
