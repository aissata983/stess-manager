<?php
/**
 * Controleur administration
 */

class AdminController
{
    private User $userModel;
    private Emotion $emotionModel;
    private HistoriqueExercice $historiqueModel;
    private HistoriqueMeditation $historiqueMeditationModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->emotionModel = new Emotion();
        $this->historiqueModel = new HistoriqueExercice();
        $this->historiqueMeditationModel = new HistoriqueMeditation();
    }

    /**
     * Tableau de bord admin
     */
    public function index(): void
    {
        requireAdmin();

        $userStats = $this->userModel->getGlobalStats();
        $emotionStats = $this->emotionModel->getGlobalStats();
        $exerciseStats = $this->historiqueModel->getGlobalStats();
        $meditationStats = $this->historiqueMeditationModel->getGlobalStats();

        view('admin.index', [
            'pageTitle' => 'Administration',
            'userStats' => $userStats,
            'emotionStats' => $emotionStats,
            'exerciseStats' => $exerciseStats,
            'meditationStats' => $meditationStats
        ]);
    }

    /**
     * Liste des utilisateurs
     */
    public function users(): void
    {
        requireAdmin();

        $users = $this->userModel->getAll();

        view('admin.users', [
            'pageTitle' => 'Gestion des utilisateurs',
            'users' => $users
        ]);
    }

    /**
     * Supprime un utilisateur
     */
    public function deleteUser(): void
    {
        requireAdmin();
        validateCsrf();

        $userId = (int) ($_POST['user_id'] ?? 0);

        if ($userId <= 0) {
            setFlash('error', 'Utilisateur invalide.');
            redirect('/admin/users');
        }

        if ($userId === getUserId()) {
            setFlash('error', 'Vous ne pouvez pas supprimer votre propre compte.');
            redirect('/admin/users');
        }

        $deleted = $this->userModel->delete($userId);

        if (!$deleted) {
            setFlash('error', 'Impossible de supprimer cet utilisateur.');
            redirect('/admin/users');
        }

        setFlash('success', 'Utilisateur supprime avec succes.');
        redirect('/admin/users');
    }

    /**
     * Statistiques globales
     */
    public function statistiques(): void
    {
        requireAdmin();

        $userStats = $this->userModel->getGlobalStats();
        $emotionStats = $this->emotionModel->getGlobalStats();
        $exerciseStats = $this->historiqueModel->getGlobalStats();
        $meditationStats = $this->historiqueMeditationModel->getGlobalStats();

        view('admin.statistiques', [
            'pageTitle' => 'Statistiques globales',
            'userStats' => $userStats,
            'emotionStats' => $emotionStats,
            'exerciseStats' => $exerciseStats,
            'meditationStats' => $meditationStats
        ]);
    }
}
