<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Conseils anti-stress</h1>
            <p>Explorez une bibliotheque de ressources pour mieux gerer votre stress.</p>
        </section>

        <div class="card mb-24">
            <form method="GET" action="<?= url('/conseils') ?>" class="filter-form">
                <div class="form-group">
                    <label for="categorie">Filtrer par categorie</label>
                    <select name="categorie" id="categorie" onchange="this.form.submit()">
                        <option value="">Toutes les categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= e($category['categorie']) ?>" <?= $selectedCategory === $category['categorie'] ? 'selected' : '' ?>>
                                <?= e(getCategoryLabel($category['categorie'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>

        <div class="cards-grid">
            <?php foreach ($conseils as $conseil): ?>
                <article class="card conseil-card">
                    <div class="card-header">
                        <h2><?= e($conseil['titre']) ?></h2>
                        <span class="tag"><?= e(getCategoryLabel($conseil['categorie'])) ?></span>
                    </div>

                    <p><?= e($conseil['resume']) ?></p>

                    <a href="<?= url('/conseils/' . $conseil['slug']) ?>" class="btn btn-outline">
                        Lire le conseil
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
