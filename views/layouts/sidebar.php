<aside class="sidebar">
    <nav class="sidebar-nav">
        <a href="<?= url('/dashboard') ?>" class="sidebar-link">
            <i class="fas fa-chart-line"></i>
            <span>Tableau de bord</span>
        </a>

        <a href="<?= url('/emotions') ?>" class="sidebar-link">
            <i class="fas fa-face-smile"></i>
            <span>Suivi emotionnel</span>
        </a>

        <a href="<?= url('/exercices') ?>" class="sidebar-link">
            <i class="fas fa-wind"></i>
            <span>Respiration</span>
        </a>

        <a href="<?= url('/meditation') ?>" class="sidebar-link">
            <i class="fas fa-brain"></i>
            <span>Meditation</span>
        </a>

        <a href="<?= url('/conseils') ?>" class="sidebar-link">
            <i class="fas fa-lightbulb"></i>
            <span>Conseils</span>
        </a>

        <a href="<?= url('/statistiques') ?>" class="sidebar-link">
            <i class="fas fa-chart-pie"></i>
            <span>Statistiques</span>
        </a>

        <a href="<?= url('/profil') ?>" class="sidebar-link">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>

        <?php if (isAdmin()): ?>
            <a href="<?= url('/admin') ?>" class="sidebar-link">
                <i class="fas fa-shield-halved"></i>
                <span>Administration</span>
            </a>
        <?php endif; ?>

        <a href="<?= url('/logout') ?>" class="sidebar-link danger">
            <i class="fas fa-right-from-bracket"></i>
            <span>Deconnexion</span>
        </a>
    </nav>
</aside>
