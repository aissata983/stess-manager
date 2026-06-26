<?php
/**
 * Controleur des exercices de respiration
 */

class ExerciceController
{
    private Exercice $exerciceModel;
    private HistoriqueExercice $historiqueModel;

    public function __construct()
    {
        $this->exerciceModel = new Exercice();
        $this->historiqueModel = new HistoriqueExercice();
    }

    /**
     * Liste des exercices
     */
    public function index(): void
    {
        requireLogin();

        $exercices = $this->exerciceModel->getAllActive();

        view('exercices.index', [
            'pageTitle' => 'Exercices de respiration',
            'exercices' => $exercices
        ]);
    }

    /**
     * Affiche un exercice
     */
    public function show(string $slug): void
    {
        requireLogin();

        $exercice = $this->exerciceModel->findBySlug($slug);

        if (!$exercice) {
            http_response_code(404);
            view('errors.404', ['pageTitle' => 'Page introuvable']);
            return;
        }

        view('exercices.show', [
            'pageTitle' => $exercice['titre'],
            'exercice' => $exercice
        ]);
    }

    /**
     * Enregistre la realisation d'un exercice
     */
    public function complete(): void
    {
        requireLogin();
        validateCsrf();

        $exerciceId = (int) ($_POST['exercice_id'] ?? 0);
        $dureeReelle = (int) ($_POST['duree_reelle_secondes'] ?? 0);

        $exercice = $this->exerciceModel->findById($exerciceId);

        if (!$exercice) {
            setFlash('error', 'Exercice introuvable.');
            redirect('/exercices');
        }

        $saved = $this->historiqueModel->create(
            getUserId(),
            $exerciceId,
            $dureeReelle > 0 ? $dureeReelle : null,
            1
        );

        if (!$saved) {
            setFlash('error', 'Impossible d\'enregistrer cet exercice.');
            redirect('/exercices/' . $exercice['slug']);
        }

        setFlash('success', 'Exercice enregistré avec succès.');
        redirect('/exercices');
    }
}
