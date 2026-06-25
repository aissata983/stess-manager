<?php require VIEWS_PATH . 'layouts/header.php'; ?>
<?php require VIEWS_PATH . 'layouts/navbar.php'; ?>

<div class="dashboard-layout">
    <?php require VIEWS_PATH . 'layouts/sidebar.php'; ?>

    <main class="main-content">
        <section class="page-header">
            <h1>Gestion des utilisateurs</h1>
            <p>Liste complete des comptes de l'application.</p>
        </section>

        <?= displayFlash(); ?>

        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Date creation</th>
                            <th>Derniere connexion</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= (int) $user['id'] ?></td>
                                <td><?= e($user['nom']) ?></td>
                                <td><?= e($user['email']) ?></td>
                                <td><?= e($user['role']) ?></td>
                                <td><?= e(formatDate($user['date_creation'], 'd/m/Y H:i')) ?></td>
                                <td><?= !empty($user['derniere_connexion']) ? e(formatDate($user['derniere_connexion'], 'd/m/Y H:i')) : '-' ?></td>
                                <td>
                                    <?php if ((int) $user['id'] !== (int) getUserId()): ?>
                                        <form action="<?= url('/admin/users/delete') ?>" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                            <?= csrfField(); ?>
                                            <input type="hidden" name="user_id" value="<?= (int) $user['id'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="tag">Compte courant</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<?php require VIEWS_PATH . 'layouts/footer.php'; ?>
