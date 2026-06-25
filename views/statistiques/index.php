<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Statistiques personnelles</h1>
            <p>Visualisez votre progression et vos habitudes de bien-etre.</p>
        </section>

        <section class="stats-grid">
            <article class="stat-card">
                <h3>Total emotions</h3>
                <p class="stat-value"><?= (int) $emotionCount ?></p>
            </article>

            <article class="stat-card">
                <h3>Total exercices</h3>
                <p class="stat-value"><?= (int) $exerciseCount ?></p>
            </article>

            <article class="stat-card">
                <h3>Total meditations</h3>
                <p class="stat-value"><?= (int) $meditationCount ?></p>
            </article>
        </section>

        <section class="content-grid stacked">
            <div class="card">
                <div class="card-header">
                    <h2>Repartition des emotions</h2>
                </div>
                <canvas
                    id="emotionDistributionChart"
                    data-labels='<?= e(json_encode(array_map(fn($item) => getMoodLabel($item["humeur"]), $distribution))) ?>'
                    data-values='<?= e(json_encode(array_map(fn($item) => (int) $item["total"], $distribution))) ?>'
                ></canvas>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Evolution du stress</h2>
                </div>
                <canvas
                    id="fullStressEvolutionChart"
                    data-labels='<?= e(json_encode(array_column($stressEvolution, "jour"))) ?>'
                    data-values='<?= e(json_encode(array_map(fn($item) => round((float) $item["niveau_moyen"], 2), $stressEvolution))) ?>'
                ></canvas>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Exercices realises</h2>
                </div>
                <canvas
                    id="exerciseStatsChart"
                    data-labels='<?= e(json_encode(array_column($dailyExercises, "jour"))) ?>'
                    data-values='<?= e(json_encode(array_map(fn($item) => (int) $item["total"], $dailyExercises))) ?>'
                ></canvas>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Meditations realisees</h2>
                </div>
                <canvas
                    id="meditationStatsChart"
                    data-labels='<?= e(json_encode(array_column($dailyMeditations, "jour"))) ?>'
                    data-values='<?= e(json_encode(array_map(fn($item) => (int) $item["total"], $dailyMeditations))) ?>'
                ></canvas>
            </div>
        </section>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
