<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1><?= e($conseil['titre']) ?></h1>
            <p><?= e(getCategoryLabel($conseil['categorie'])) ?></p>
        </section>

        <article class="card formatted-text">
            <?= nl2br(e($conseil['contenu'])) ?>
        </article>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
