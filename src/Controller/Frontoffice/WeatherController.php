<?php

declare(strict_types=1);

namespace  App\Controller\Frontoffice;

use App\Model\WeatherManager;
use App\View\View;

class WeatherController
{
    private WeatherManager $weatherManager;
    private View $view;

    public function __construct(WeatherManager $weatherManager, View $view)
    {
        $this->weatherManager = $weatherManager;
        $this->view = $view;
    }

    public function readWeatherStack(): void
    {
        $location = "New York";
        $data = $this->weatherManager->weatherOfLocation($location);

        $this->view->render(['template' => 'weather', 'allweather' => $data, 'location' => $location], 'frontoffice');
    }
}
