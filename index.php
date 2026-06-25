<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/session.php';

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/flash.php';
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/auth.php';

require_once __DIR__ . '/models/Conseil.php';
require_once __DIR__ . '/models/DataBase.php';
require_once __DIR__ . '/models/Emotion.php';
require_once __DIR__ . '/models/Exercice.php';
require_once __DIR__ . '/models/HistoriqueExercice.php';
require_once __DIR__ . '/models/HistoriqueMeditation.php';
require_once __DIR__ . '/models/Meditation.php';
require_once __DIR__ . '/models/User.php';

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/DashboardController.php';
require_once __DIR__ . '/controllers/EmotionController.php';
require_once __DIR__ . '/controllers/ExerciceController.php';
require_once __DIR__ . '/controllers/MeditationController.php';
require_once __DIR__ . '/controllers/ConseilController.php';
require_once __DIR__ . '/controllers/StatistiqueController.php';
require_once __DIR__ . '/controllers/ProfilController.php';
require_once __DIR__ . '/controllers/AdminController.php';

require_once __DIR__ . '/router.php';
