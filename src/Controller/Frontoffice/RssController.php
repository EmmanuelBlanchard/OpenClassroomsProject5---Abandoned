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
}
