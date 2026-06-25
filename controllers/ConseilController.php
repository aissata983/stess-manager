<?php
/**
 * Controleur des conseils
 */

class ConseilController
{
    private Conseil $conseilModel;

    public function __construct()
    {
        $this->conseilModel = new Conseil();
    }

    /**
     * Liste des conseils
     */
    public function index(): void
    {
        requireLogin();

        $categorie = trim($_GET['categorie'] ?? '');
        $categories = $this->conseilModel->getCategories();

        if ($categorie !== '') {
            $conseils = $this->conseilModel->getByCategory($categorie);
        } else {
            $conseils = $this->conseilModel->getAllActive();
        }

        view('conseils.index', [
            'pageTitle' => 'Conseils anti-stress',
            'conseils' => $conseils,
            'categories' => $categories,
            'selectedCategory' => $categorie
        ]);
    }

    /**
     * Detail d'un conseil
     */
    public function show(string $slug): void
    {
        requireLogin();

        $conseil = $this->conseilModel->findBySlug($slug);

        if (!$conseil) {
            http_response_code(404);
            view('errors.404', ['pageTitle' => 'Page introuvable']);
            return;
        }

        view('conseils.detail', [
            'pageTitle' => $conseil['titre'],
            'conseil' => $conseil
        ]);
    }
}
