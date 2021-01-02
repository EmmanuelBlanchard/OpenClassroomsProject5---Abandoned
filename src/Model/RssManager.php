<?php

declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class RssManager
{
    private $database;
    
    public function __construct(Database $database)
    {
        $this->database = $database->getPdo();
    }

    public function retrieveRssWebsite(string $url, string $website, string $webiste_url)
    {
        $rss = simplexml_load_file($url);
        //echo '<pre>';
        //var_dump($rss);
        //echo '</pre>';
        //die();
        foreach ($rss->channel->item as $item) {
            $link = $item->link;
            $title = $item->title;
            //$datetime = date_create($item->pubDate);
            $datetime = date_create((string) $item->pubDate);
            /*
            $date = date_create('2000-01-01');
            echo date_format($date, 'Y-m-d H:i:s');
            */
            $date = date_format($datetime, 'd M Y');
            $post_date = date_format($datetime, 'Y-m-d H:i:s');

            //echo '<pre>';
            //var_dump($rss, $link, $title , $datetime, $date, $post_date);
            //echo '</pre>';
            //die();

            $request = $this->database->prepare('SELECT link FROM feeds WHERE link = :link');
            //$request->bindParam(':link', $link);
            $request->bindValue(':link', $link, \PDO::PARAM_STR);
            $request->execute();
            $results = $request->fetch(\PDO::FETCH_ASSOC);

            //var_dump($results);
            //die();

            if ($results === false) {

                //echo '<pre>';
                //var_dump("Resultas faux");
                //echo '</pre>';
                //die();

                $request = $this->database->prepare('INSERT INTO feeds (title, link, date_item, website_origin, website_url, post_date) VALUES (:title, :link, :date_item, :website_origin, :website_url, :post_date)');
                
                return $request->execute([
                    'title' => $title,
                    'link' => $link,
                    'date_item' => $date,
                    'website_origin' => $website,
                    'website_url' => $webiste_url,
                    'post_date' => $post_date
                ]);
            }
        }
    }

    public function feed($feedURL): void
    {
        $i = 0; // initiate counter to limit the amount of articles to return
        $url = $feedURL; // url to parse
        $rss = simplexml_load_file($url); // the XML parser
            // RSS items loop
            foreach ($rss->channel->item as $item) {  //loop through each item
                $link = $item->link;  //extract the link
                $title = $item->title;  //extract the title
                $date = $item->pubDate;  //extract the date
                $description = strip_tags((string) $item->description);  //extract description and strip HTML
                    if (mb_strlen($description) > 200) {
                        // truncate string if greater than 200 characters
                        $stringCut = mb_substr($description, 0, 200);
                        // make sure it ends in a complete word and add ... at the end
                        $description = mb_substr($stringCut, 0, mb_strrpos($stringCut, ' ')).'...';
                    }
                if ($i < 8) { // parse only 8 items
                    echo '
                            <a class="list-group-item" href="'.$link.'" target="_blank">
                                <h5 class="list-group-item-heading">'.$title.'<br><small>'.$date.'</small></h5>
                                <p class="list-group-item-text">'.$description.'</p>
                            </a>
                            ';
                }
                $i++;
            }
    }

    public function feed1(string $feedURL, string $website, string $webiste_url)
    {
        $i = 0; // initiate counter to limit the amount of articles to return
        $url = $feedURL; // url to parse
        $rss = simplexml_load_file($url); // the XML parser
        // RSS items loop
        foreach ($rss->channel->item as $item) {  //loop through each item
            $link = $item->link;  //extract the link
            $title = $item->title;  //extract the title
            $date = $item->pubDate;  //extract the date
            $datetime = date_create((string) $item->pubDate);
            $date = date_format($datetime, 'd M Y');
            $post_date = date_format($datetime, 'Y-m-d H:i:s');

            $request = $this->database->prepare('SELECT link FROM feeds WHERE link = :link');
            $request->bindValue(':link', $link, \PDO::PARAM_STR);
            $request->execute();
            $results = $request->fetch(\PDO::FETCH_ASSOC);

            if ($results === false) {
                $request = $this->database->prepare('INSERT INTO feeds (title, link, date_item, website_origin, website_url, post_date) VALUES (:title, :link, :date_item, :website_origin, :website_url, :post_date)');
                
                return $request->execute([
                    'title' => $title,
                    'link' => $link,
                    'date_item' => $date,
                    'website_origin' => $website,
                    'website_url' => $webiste_url,
                    'post_date' => $post_date
                ]);
            }
        }
    }
}
