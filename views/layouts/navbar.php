<?php $user = getUser(); ?>
<header class="topbar">
    <div class="topbar-left">
        <a href="<?= url('/dashboard') ?>" class="brand">
            <span class="brand-icon"><i class="fas fa-spa"></i></span>
            <span class="brand-text"><?= e(APP_NAME) ?></span>
        </a>
    </div>

    <div class="topbar-right">
        <button class="theme-toggle" id="themeToggle" type="button" aria-label="Changer le theme">
            <i class="fas fa-moon"></i>
        </button>

        <?php if ($user): ?>
            <div class="user-chip">
                <span class="user-chip-avatar">
                    <?= strtoupper(mb_substr($user['nom'], 0, 1)) ?>
                </span>
                <div class="user-chip-info">
                    <strong><?= e($user['nom']) ?></strong>
                    <small><?= e($user['role']) ?></small>
                </div>
            </div>
        <?php endif; ?>
    </div>
</header>
