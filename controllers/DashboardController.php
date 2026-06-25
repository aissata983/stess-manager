<?php
/**
 * Controleur du tableau de bord
 */

class DashboardController
{
    private Emotion $emotionModel;
    private HistoriqueExercice $historiqueExerciceModel;
    private HistoriqueMeditation $historiqueMeditationModel;

    public function __construct()
    {
        $this->emotionModel = new Emotion();
        $this->historiqueExerciceModel = new HistoriqueExercice();
        $this->historiqueMeditationModel = new HistoriqueMeditation();
    }

    /**
     * Affiche le tableau de bord
     */
    public function index(): void
    {
        requireLogin();

        $userId = getUserId();
        $latestEmotion = $this->emotionModel->getLatestByUser($userId);
        $emotionHistory = $this->emotionModel->getByUser($userId, 5);
        $emotionCount = $this->emotionModel->countByUser($userId);
        $exerciceCount = $this->historiqueExerciceModel->countByUser($userId);
        $meditationCount = $this->historiqueMeditationModel->countByUser($userId);
        $weeklyExercises = $this->historiqueExerciceModel->countLast7Days($userId);
        $stressEvolution = $this->emotionModel->getStressEvolution($userId, 7);

        view('dashboard.index', [
            'pageTitle' => 'Tableau de bord',
            'user' => getUser(),
            'latestEmotion' => $latestEmotion,
            'emotionHistory' => $emotionHistory,
            'emotionCount' => $emotionCount,
            'exerciceCount' => $exerciceCount,
            'meditationCount' => $meditationCount,
            'weeklyExercises' => $weeklyExercises,
            'stressEvolution' => $stressEvolution
        ]);
    }
}
