<?php
/**
 * Controleur des meditations
 */

class MeditationController
{
    private Meditation $meditationModel;
    private HistoriqueMeditation $historiqueMeditationModel;

    public function __construct()
    {
        $this->meditationModel = new Meditation();
        $this->historiqueMeditationModel = new HistoriqueMeditation();
    }

    /**
     * Liste des meditations
     */
    public function index(): void
    {
        requireLogin();

        $meditations = $this->meditationModel->getAllActive();

        view('meditation.index', [
            'pageTitle' => 'Méditation guidée',
            'meditations' => $meditations
        ]);
    }

    /**
     * Affiche une meditation
     */
    public function show(string $slug): void
    {
        requireLogin();

        $meditation = $this->meditationModel->findBySlug($slug);

        if (!$meditation) {
            http_response_code(404);
            view('errors.404', ['pageTitle' => 'Page introuvable']);
            return;
        }

        view('meditation.show', [
            'pageTitle' => $meditation['titre'],
            'meditation' => $meditation
        ]);
    }

    /**
     * Enregistre une meditation terminee
     */
    public function complete(): void
    {
        requireLogin();
        validateCsrf();

        $meditationId = (int) ($_POST['meditation_id'] ?? 0);
        $dureeReelleMinutes = (int) ($_POST['duree_reelle_minutes'] ?? 0);

        $meditation = $this->meditationModel->findById($meditationId);

        if (!$meditation) {
            setFlash('error', 'Méditation introuvable.');
            redirect('/meditation');
        }

        $saved = $this->historiqueMeditationModel->create(
            getUserId(),
            $meditationId,
            $dureeReelleMinutes > 0 ? $dureeReelleMinutes : null,
            1
        );

        if (!$saved) {
            setFlash('error', 'Impossible d\'enregistrer cette méditation.');
            redirect('/meditation/' . $meditation['slug']);
        }

        setFlash('success', 'Méditation enregistrée avec succès.');
        redirect('/meditation');
    }
}
