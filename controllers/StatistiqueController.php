<?php
/**
 * Controleur des statistiques
 */

class StatistiqueController
{
    private Emotion $emotionModel;
    private HistoriqueExercice $historiqueModel;
    private HistoriqueMeditation $historiqueMeditationModel;

    public function __construct()
    {
        $this->emotionModel = new Emotion();
        $this->historiqueModel = new HistoriqueExercice();
        $this->historiqueMeditationModel = new HistoriqueMeditation();
    }

    /**
     * Affiche les statistiques personnelles
     */
    public function index(): void
    {
        requireLogin();

        $userId = getUserId();

        $distribution = $this->emotionModel->getDistributionByUser($userId);
        $stressEvolution = $this->emotionModel->getStressEvolution($userId, 30);
        $dailyExercises = $this->historiqueModel->getDailyStats($userId, 30);
        $dailyMeditations = $this->historiqueMeditationModel->getDailyStats($userId, 30);
        $emotionCount = $this->emotionModel->countByUser($userId);
        $exerciseCount = $this->historiqueModel->countByUser($userId);
        $meditationCount = $this->historiqueMeditationModel->countByUser($userId);

        view('statistiques.index', [
            'pageTitle' => 'Statistiques',
            'distribution' => $distribution,
            'stressEvolution' => $stressEvolution,
            'dailyExercises' => $dailyExercises,
            'dailyMeditations' => $dailyMeditations,
            'emotionCount' => $emotionCount,
            'exerciseCount' => $exerciseCount,
            'meditationCount' => $meditationCount
        ]);
    }
}
