<?php
/**
 * Controleur d'authentification
 */

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLogin(): void
    {
        redirectIfLoggedIn();
        view('auth.login', [
            'pageTitle' => 'Connexion'
        ]);
    }

    public function login(): void
    {
        validateCsrf();

        $email = trim($_POST['email'] ?? '');
        $motDePasse = $_POST['mot_de_passe'] ?? '';

        if (empty($email) || empty($motDePasse)) {
            setFlash('error', 'Tous les champs sont obligatoires.');
            redirect('/login');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            setFlash('error', 'Adresse email invalide.');
            redirect('/login');
        }

        $user = $this->userModel->authenticate($email, $motDePasse);

        if (!$user) {
            setFlash('error', 'Identifiants incorrects.');
            redirect('/login');
        }

        if ((int) ($user['actif'] ?? 1) !== 1) {
            setFlash('error', 'Votre compte est desactive.');
            redirect('/login');
        }

        loginUser($user);
        regenerateCsrfToken();

        setFlash('success', 'Connexion reussie. Bienvenue ' . $user['nom'] . ' !');
        redirect('/dashboard');
    }

    public function showRegister(): void
    {
        redirectIfLoggedIn();
        view('auth.register', [
            'pageTitle' => 'Inscription'
        ]);
    }

    public function register(): void
    {
        validateCsrf();

        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $motDePasse = $_POST['mot_de_passe'] ?? '';
        $confirmation = $_POST['confirmation_mot_de_passe'] ?? '';

        if (empty($nom) || empty($email) || empty($motDePasse) || empty($confirmation)) {
            setFlash('error', 'Tous les champs sont obligatoires.');
            redirect('/register');
        }

        if (mb_strlen($nom) < 2) {
            setFlash('error', 'Le nom doit contenir au moins 2 caracteres.');
            redirect('/register');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            setFlash('error', 'Adresse email invalide.');
            redirect('/register');
        }

        if (strlen($motDePasse) < PASSWORD_MIN_LENGTH) {
            setFlash('error', 'Le mot de passe doit contenir au moins ' . PASSWORD_MIN_LENGTH . ' caracteres.');
            redirect('/register');
        }

        if ($motDePasse !== $confirmation) {
            setFlash('error', 'Les mots de passe ne correspondent pas.');
            redirect('/register');
        }

        if ($this->userModel->emailExists($email)) {
            setFlash('error', 'Cette adresse email est deja utilisee.');
            redirect('/register');
        }

        $created = $this->userModel->create($nom, $email, $motDePasse);

        if (!$created) {
            setFlash('error', 'Une erreur est survenue lors de l\'inscription.');
            redirect('/register');
        }

        setFlash('success', 'Inscription reussie. Vous pouvez maintenant vous connecter.');
        redirect('/login');
    }

    public function logout(): void
    {
        requireLogin();
        logoutUser();
        setFlash('success', 'Vous avez ete deconnecte avec succes.');
        redirect('/login');
    }
}
