USE stress_manager;

INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES
('Administrateur', 'admin@stressmanager.fr', '$2y$10$wH8nV7W0kzQjv1x0mIh2EOpVx0m8Dk3A0WkY3vQmN1v2HfV0KpN4a', 'admin'),
('Utilisateur Test', 'user@stressmanager.fr', '$2y$10$wH8nV7W0kzQjv1x0mIh2EOpVx0m8Dk3A0WkY3vQmN1v2HfV0KpN4a', 'user');

INSERT INTO exercices (titre, slug, description, instructions, duree_secondes, type, difficulte, parametres, icone, couleur, ordre_affichage) VALUES
(
    'Respiration Carree 4-4-4-4',
    'respiration-carree-4444',
    'Technique simple pour calmer le systeme nerveux et retrouver rapidement un etat de stabilite.',
    '1. Inspirez par le nez pendant 4 secondes.\n2. Retenez votre souffle pendant 4 secondes.\n3. Expirez pendant 4 secondes.\n4. Retenez poumons vides pendant 4 secondes.\nRepetez plusieurs cycles calmement.',
    240,
    'respiration',
    'debutant',
    '{"inspire":4,"retention_haute":4,"expire":4,"retention_basse":4,"cycles":6}',
    'square',
    '#4A90A4',
    1
),
(
    'Respiration Profonde',
    'respiration-profonde',
    'Exercice de respiration abdominale pour detendre le corps et ralentir le rythme interieur.',
    '1. Inspirez profondement par le nez pendant 5 secondes.\n2. Retenez 2 secondes.\n3. Expirez lentement par la bouche pendant 7 secondes.\nConcentrez-vous sur le ventre qui se gonfle puis se relache.',
    300,
    'respiration',
    'debutant',
    '{"inspire":5,"retention_haute":2,"expire":7,"retention_basse":0,"cycles":8}',
    'wind',
    '#6B8E23',
    2
),
(
    'Respiration Anti-Anxiete 4-7-8',
    'respiration-anti-anxiete-478',
    'Methode efficace pour reduire l anxiete et retrouver un apaisement rapide.',
    '1. Inspirez silencieusement pendant 4 secondes.\n2. Retenez votre souffle pendant 7 secondes.\n3. Expirez lentement pendant 8 secondes.\nRepetez 4 cycles.',
    180,
    'respiration',
    'intermediaire',
    '{"inspire":4,"retention_haute":7,"expire":8,"retention_basse":0,"cycles":4}',
    'cloud',
    '#9370DB',
    3
);

INSERT INTO meditations (titre, slug, description, contenu_guide, duree_minutes, type, niveau, theme, ordre_affichage) VALUES
(
    'Meditation 5 minutes',
    'meditation-5-minutes',
    'Courte seance ideale pour commencer ou faire une pause relaxante.',
    'Installez-vous confortablement.\nFermez les yeux.\nObservez simplement votre respiration.\nSi une pensee apparait, laissez-la passer puis revenez au souffle.\nRestez dans le calme jusqu a la fin de la seance.',
    5,
    'guidee',
    'debutant',
    'decouverte',
    1
),
(
    'Meditation 10 minutes',
    'meditation-10-minutes',
    'Seance anti-stress pour relacher les tensions et retrouver le calme.',
    'Prenez une grande inspiration.\nRelachez les epaules.\nPortez votre attention sur chaque partie du corps.\nLaissez les tensions diminuer a chaque expiration.\nRevenez doucement a votre respiration.',
    10,
    'guidee',
    'debutant',
    'stress',
    2
),
(
    'Meditation 15 minutes',
    'meditation-15-minutes',
    'Seance plus immersive avec visualisation et recentrage profond.',
    'Visualisez un lieu paisible.\nMarchez mentalement dans cet espace calme.\nRespirez lentement.\nLaissez les pensees passer sans les retenir.\nRessentez la paix interieure s installer durablement.',
    15,
    'visualisation',
    'intermediaire',
    'relaxation_profonde',
    3
);

INSERT INTO conseils (titre, slug, contenu, resume, categorie, icone, actif, ordre_affichage) VALUES
(
    'Mieux gerer son temps',
    'gestion-du-temps',
    'Planifiez vos taches, priorisez l important et evitez de tout faire en meme temps. Fractionner une grande tache diminue la charge mentale.',
    'Apprenez a prioriser pour reduire la surcharge mentale.',
    'temps',
    'clock',
    1,
    1
),
(
    'Ameliorer son sommeil',
    'ameliorer-sommeil',
    'Couchez-vous a heures regulieres, limitez les ecrans avant le coucher et installez un rituel apaisant le soir.',
    'Le sommeil est une base essentielle de la gestion du stress.',
    'sommeil',
    'moon',
    1,
    2
),
(
    'Mieux manger en periode de stress',
    'alimentation-anti-stress',
    'Privilegiez une alimentation equilibree, hydratez-vous suffisamment et limitez les exces de cafeine ou de sucre.',
    'Une alimentation stable aide le corps a mieux reguler le stress.',
    'alimentation',
    'apple-alt',
    1,
    3
),
(
    'Bouger regulierement',
    'activite-physique',
    'Une marche quotidienne, quelques etirements ou une activite douce peuvent reduire nettement le niveau de stress.',
    'L activite physique aide a evacuer la tension nerveuse.',
    'physique',
    'walking',
    1,
    4
),
(
    'Pratiquer la relaxation',
    'relaxation',
    'Prenez quelques minutes chaque jour pour respirer, mediter ou simplement faire une pause sans ecran.',
    'La relaxation quotidienne a un effet cumulatif tres positif.',
    'relaxation',
    'spa',
    1,
    5
),
(
    'Prendre du recul mental',
    'gestion-mentale',
    'Essayez de distinguer les faits de vos pensees automatiques. Reformuler une pensee negative peut reduire sa charge emotionnelle.',
    'Le recul cognitif diminue souvent l intensite du stress ressenti.',
    'mental',
    'brain',
    1,
    6
);

INSERT INTO emotions (utilisateur_id, humeur, commentaire, niveau_stress, date_enregistrement) VALUES
(2, 'stresse', 'Journee chargee', 7, DATE_SUB(NOW(), INTERVAL 6 DAY)),
(2, 'neutre', 'Ca va mieux', 5, DATE_SUB(NOW(), INTERVAL 5 DAY)),
(2, 'heureux', 'Bonne nouvelle aujourd hui', 3, DATE_SUB(NOW(), INTERVAL 4 DAY)),
(2, 'stresse', 'Beaucoup de travail', 6, DATE_SUB(NOW(), INTERVAL 3 DAY)),
(2, 'tres_stresse', 'Fatigue accumulee', 8, DATE_SUB(NOW(), INTERVAL 2 DAY)),
(2, 'neutre', 'Pause utile', 4, DATE_SUB(NOW(), INTERVAL 1 DAY)),
(2, 'heureux', 'Journee sereine', 2, NOW());

INSERT INTO historique_exercices (utilisateur_id, exercice_id, duree_reelle_secondes, complete, note, date_realisation) VALUES
(2, 1, 240, 1, 4, DATE_SUB(NOW(), INTERVAL 5 DAY)),
(2, 2, 300, 1, 5, DATE_SUB(NOW(), INTERVAL 4 DAY)),
(2, 1, 240, 1, 4, DATE_SUB(NOW(), INTERVAL 3 DAY)),
(2, 3, 180, 1, 5, DATE_SUB(NOW(), INTERVAL 2 DAY)),
(2, 2, 300, 1, 4, DATE_SUB(NOW(), INTERVAL 1 DAY)),
(2, 1, 240, 1, 5, NOW());

INSERT INTO historique_meditations (utilisateur_id, meditation_id, duree_reelle_minutes, complete, note, date_realisation) VALUES
(2, 1, 5, 1, 4, DATE_SUB(NOW(), INTERVAL 6 DAY)),
(2, 2, 10, 1, 5, DATE_SUB(NOW(), INTERVAL 3 DAY)),
(2, 3, 15, 1, 5, DATE_SUB(NOW(), INTERVAL 1 DAY));
