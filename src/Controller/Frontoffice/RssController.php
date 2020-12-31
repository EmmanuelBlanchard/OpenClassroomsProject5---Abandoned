<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\Model\RssManager;
use App\View\View;

class RssController
{
    private RssManager $rssManager;
    private View $view;

    public function __construct(RssManager $rssManager, View $view)
    {
        $this->rssManager = $rssManager;
        $this->view = $view;
    }

    public function displayHomeWithTheLastThreePosts(): void
    {
        $data = $this->postManager->showLastThreePosts();

        $this->view->render(['template' => 'home', 'allposts' => $data], 'frontoffice');
    }
    
    public function browseRssFeeds($url, $website, $webiste_url)
    {
        $data = $this->rssManager->retrieveRssWebsite($url, $website, $webiste_url);
        
        //echo '<pre>';
        //var_dump($data);
        //echo '</pre>';
        //die();

        $this->view->render(['template' => 'rss', 'allrss' => $data], 'frontoffice');
    }

    public function retrieveRssFromTheSite(string $url, string $website, string $webiste_url)
    {
        $rss = simplexml_load_file($url);

        echo '<pre>';
        var_dump($rss);
        echo '</pre>';
        die();
    }

    public function retrieveRss(string $url): void
    {
        $data = $this->rssManager->feed($url);

        $this->view->render(['template' => 'rss1', 'allrss' => $data], 'frontoffice');
    }
    
    public function retrieveRss1(string $url, string $website, string $webiste_url): void
    {
        $data = $this->rssManager->feed1($url, $website, $webiste_url);
        //echo '<pre>';
        //var_dump($data);
        //echo '</pre>';
        //die();
        // bool(true)
        /*
         Whoops \ Exception \ ErrorException (E_WARNING)
        Invalid argument supplied for foreach()
        */
        $this->view->render(['template' => 'rss1', 'allrss' => $data], 'frontoffice');
    }
    
}
