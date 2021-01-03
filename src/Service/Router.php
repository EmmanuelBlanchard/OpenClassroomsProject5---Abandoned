<?php

declare(strict_types=1);

namespace  App\Service;

use App\Controller\Frontoffice\PostController;
use App\Controller\Frontoffice\RssController;
use App\Controller\Frontoffice\WeatherController;
use App\Model\PostManager;
use App\Model\RssManager;
use App\Model\WeatherManager;
use App\Service\Database;
use App\Service\Http\Request;
use App\View\View;

// cette classe router est un exemple très basic. Cette façon de faire n'est pas optimale
class Router
{
    private Database $database;
    private PostManager $postManager;
    private RssManager $rssManager;
    private WeatherManager $weatherManager;
    private View $view;
    private PostController $postController;
    private RssController $rssController;
    private WeatherController $weatherController;
    private Request $request;

    public function __construct()
    {
        // Dépendances
        $this->database = new Database();
        $this->postManager = new PostManager($this->database);
        $this->rssManager = new RssManager($this->database);
        $this->weatherManager = new WeatherManager($this->database);
        $this->view = new View();
        $this->request = new Request();

        // Injection des dépendances
        $this->postController = new PostController($this->postManager, $this->view);
        $this->rssController = new RssController($this->rssManager, $this->view);
        $this->weatherController = new WeatherController($this->weatherManager, $this->view);
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

        //echo '<pre>';
        //var_dump($this->request->getGetItem('action'));
        //echo '</pre>';
        //die();

        $action = $this->request->getGetItem('action') ?? 'home';

        // Déterminer sur quelle route nous sommes // Attention algorithme naïf
        if ($action === 'home') {
            // route http://localhost:8000/?action=home
            $this->postController->displayHomeWithTheLastThreePosts();
        } elseif ($action === 'listOfRss') {
            // route http://localhost:8000/?action=listOfRss
            
            //$this->rssController->browseRssFeeds("https://www.developpez.com/index/rss", "Developpez.com", "https://www.developpez.com");
            //   Whoops \ Exception \ ErrorException (E_WARNING) Invalid argument supplied for foreach()
            $this->rssController->browseRssFeeds("https://www.pourlascience.fr/rss.xml", "Pourlascience", "https://www.pourlascience.fr/");
        //$this->rssController->browseRssFeeds("https://syndication.lesechos.fr/rss/rss_france.xml", "LesEchos", "https://syndication.lesechos.fr/");
            //$this->rssController->browseRssFeeds("https://www.lefigaro.fr/rss/figaro_actualites.xml", "Le Figaro", "https://www.lefigaro.fr");
            //$this->rssController->browseRssFeeds("https://www.latribune.fr/rss/rubriques/actualite.html", "La Tribune", "http://www.latribune.fr");
            //$this->rssController->browseRssFeeds("https://www.europe1.fr/rss.xml", "Europe 1", "https://www.europe1.fr/");
            //$this->rssController->browseRssFeeds("https://www.francetvinfo.fr/france.rss", "France Info", "https://www.francetvinfo.fr/");
            // simplexml_load_file(): https://www.francetvinfo.fr/eco.rss:1: parser error : xmlParseEntityRef: no name
            //$this->rssController->browseRssFeeds("https://www.francetvinfo.fr/eco.rss", "France Info Eco", "https://www.francetvinfo.fr/");
            //$this->rssController->browseRssFeeds("https://www.lemonde.fr/rss/une.xml", "Le Monde", "https://www.lemonde.fr");
            
            // Recuperation liens rss et test des sites sur https://www.scriptol.fr/rss/rss-simple.php
            // https://www.20minutes.fr/feeds/rss-une.xml

            // https://blog.openclassrooms.com/blog/category/developpement-informatique/rss
            // https://linformaticien.com/rss
            // https://www.lemondeinformatique.fr/flux-rss/thematique/toutes-les-actualites/rss.xml
            // https://www.informatiquenews.fr/feed
            // https://www.blogdumoderateur.com/rss
            // https://www.usine-digitale.fr/rss
            // https://www.tomshardware.fr/rss
            // https://www.01net.com/rss/actualites/
            // https://www.clubic.com/feed/news.rss

            // https://www.silicon.fr/feed

            // https://korben.info/rss
            // https://www.journaldunet.com/rss/
            // https://www.journaldunet.com/web-tech/rss/
            // https://www.journaldunet.com/web-tech/developpeur/rss/

            // https://www.developpez.com/index/rss
            // https://feeds.feedburner.com/symfony/blog
            // https://css-tricks.com/rss
            // https://putaindecode.io/api/articles/feeds/desc/feed.xml

            // https://www.jeuxvideo.com/jvxml.htm  // http://www.jeuxvideo.com/rss/rss.xml // https://www.jeuxvideo.com/rss/rss-news.xml // ne fonctionne pas
            // http://www.jeuxvideo.fr/xml/tout.xml // ne fonctionne pas

            // https://www.jeuxactu.com/rss/ja.rss
        } elseif ($action === 'rss') {
            // route http://localhost:8000/?action=rss
            $this->rssController->retrieveRssFromTheSite("http://www.lefigaro.fr/rss/figaro_actualites.xml", "Le Figaro", "https://www.lefigaro.fr/");
        } elseif ($action === 'tryRss') {
            // route http://localhost:8000/?action=tryRss
            //$this->rssController->retrieveRss("http://www.lefigaro.fr/rss/figaro_actualites.xml");
            $this->rssController->retrieveRss1("http://www.lefigaro.fr/rss/figaro_actualites.xml", "Le Figaro", "https://www.lefigaro.fr/");
        } elseif ($action === 'readRssJs') {
            // route http://localhost:8000/?action=readRssJs
            $this->rssController->readRssJs();
        } elseif ($action === 'readJsRssReader') {
            // route http://localhost:8000/?action=readJsRssReader
            $this->rssController->readJsRssReader();
        } elseif ($action === 'readWeatherStack') {
            // route http://localhost:8000/?action=readWeatherStack
            $this->weatherController->readWeatherStack();
        } else {
            // faire un controller pour la gestion d'erreur
            echo "Error 404 - cette page n'existe pas<br><a href=http://localhost:8000/?action=post&id=5>Aller Ici</a>";
        }
    }
}
