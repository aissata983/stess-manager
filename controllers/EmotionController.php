<?php
/**
 * Controleur des emotions
 */

class EmotionController
{
    private Emotion $emotionModel;

    public function __construct()
    {
        $this->emotionModel = new Emotion();
    }

    /**
     * Liste des emotions
     */
    public function index(): void
    {
        requireLogin();

        $userId = getUserId();
        $emotions = $this->emotionModel->getByUser($userId, 50);

        view('emotions.index', [
            'pageTitle' => 'Suivi emotionnel',
            'emotions' => $emotions
        ]);
    }

    /**
     * Affiche le formulaire d'ajout
     */
    public function create(): void
    {
        requireLogin();

        view('emotions.create', [
            'pageTitle' => 'Ajouter une emotion'
        ]);
    }

    /**
     * Enregistre une emotion
     */
    public function store(): void
    {
        requireLogin();
        validateCsrf();

        $humeur = trim($_POST['humeur'] ?? '');
        $commentaire = trim($_POST['commentaire'] ?? '');
        $niveauStress = $_POST['niveau_stress'] ?? null;

        $humeursAutorisees = ['tres_heureux', 'heureux', 'neutre', 'stresse', 'tres_stresse'];

        if (!in_array($humeur, $humeursAutorisees, true)) {
            setFlash('error', 'Humeur invalide.');
            redirect('/emotions/create');
        }

        if ($niveauStress !== null && $niveauStress !== '') {
            $niveauStress = (int) $niveauStress;
            if ($niveauStress < 1 || $niveauStress > 10) {
                setFlash('error', 'Le niveau de stress doit être compris entre 1 et 10.');
                redirect('/emotions/create');
            }
        } else {
            $niveauStress = null;
        }

        $commentaire = $commentaire !== '' ? $commentaire : null;

        $created = $this->emotionModel->create(getUserId(), $humeur, $commentaire, $niveauStress);

        if (!$created) {
            setFlash('error', 'Impossible d\'enregistrer votre émotion.');
            redirect('/emotions/create');
        }

        setFlash('success', 'Emotion enregistrée avec succès.');
        redirect('/emotions');
    }

    /**
     * Historique detaille
     */
    public function history(): void
    {
        requireLogin();

        $userId = getUserId();
        $emotions = $this->emotionModel->getByUser($userId, 100);

        view('emotions.history', [
            'pageTitle' => 'Historique des émotions',
            'emotions' => $emotions
        ]);
    }
}
