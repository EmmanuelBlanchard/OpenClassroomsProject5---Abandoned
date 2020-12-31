<?php

declare(strict_types=1);

namespace  App\Service;

use App\Controller\Frontoffice\PostController;
use App\Controller\Frontoffice\RssController;
use App\Model\PostManager;
use App\Model\RssManager;
use App\Service\Http\Request;
use App\View\View;

// cette classe router est un exemple très basic. Cette façon de faire n'est pas optimale
class Router
{
    private PostManager $postManager;
    private RssManager $rssManager;
    private View $view;
    private PostController $postController;
    private RssController $rssController;
    private Request $request;

    public function __construct()
    {
        // Dépendances
        $this->postManager = new PostManager();
        $this->view = new View();
        $this->request = new Request();

        // Injection des dépendances
        $this->postController = new PostController($this->postManager, $this->view);
        $this->rssController = new RssController($this->rssManager, $this->view);
    }

    public function run(): void
    {
        /*
        $action = isset($this->get['action']) && isset($this->get['id']) && $this->get['action'] === 'post';

        if ($action) {
            // route http://localhost:8000/?action=post&id=5
            $this->postController->displayOneAction((int)$this->get['id']);
        } elseif (!$action) {
            // faire un controller pour la gestion d'erreur
            echo "Error 404 - cette page n'existe pas<br><a href=http://localhost:8000/?action=post&id=5>Aller Ici</a>";
        }
        */

        $action = $this->request->getGetItem('action') ?? 'home';

        // Déterminer sur quelle route nous sommes // Attention algorithme naïf
        if ($action === 'home') {
            // route http://localhost:8000/?action=home
            $this->postController->displayHomeWithTheLastThreePosts();
        } else {
            // faire un controller pour la gestion d'erreur
            echo "Error 404 - cette page n'existe pas<br><a href=http://localhost:8000/?action=post&id=5>Aller Ici</a>";
        }
    }
}
