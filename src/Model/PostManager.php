<?php

declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class PostManager
{
    private $database;
    
    public function __construct(Database $database)
    {
        $this->database = $database->getPdo();
    }
    
    public function showOne(int $id): ?array
    {
        // *** exemple fictif d'accès à la base de données
        if ($id > 600) {
            return null;
        }

        return ['id' => $id, 'title' => 'Article '. $id .' du blog', 'text' => 'Lorem ipsum'];
    }

    public function showLastThreePosts(): ?array
    {
        return array(['id' => '89', 'title' => 'Article 89 du blog', 'introduction' => 'Vivamus hendrerit facilisis neque, lobortis efficitur lorem finibus vel. 
        Nulla sem risus, dignissim ut vestibulum id, blandit sed quam. Vestibulum lobortis interdum dolor sit amet ultrices. Vivamus non augue at sem iaculis 
        placerat eget et diam. Vivamus hendrerit ex massa, ut elementum erat cursus non. Fusce viverra dui ipsum, congue convallis lacus mollis at. Morbi eu felis turpis. ',
         'post_date' => '2020-01-05 17:57:00.000000', 'text' => 'Lorem ipsum'],
        ['id' => '99', 'title' => 'Article 99 du blog', 'introduction' => 'Curabitur ac efficitur enim. Vestibulum vestibulum vel nulla sed fermentum. 
        Duis eget erat luctus eros convallis ornare eu sed ex. Etiam vitae condimentum massa, ut mollis dolor. Maecenas laoreet elit eu consequat finibus. 
        Fusce vitae porttitor est. Morbi a consequat nisl. Vestibulum cursus facilisis lobortis. ',
         'post_date' => '2020-02-05 17:57:00.000000', 'text' => 'Lorem ipsum'],
        ['id' => '109', 'title' => 'Article 109 du blog', 'introduction' => 'Donec leo arcu, varius eu vestibulum id, gravida tincidunt mi.
         Integer auctor efficitur pulvinar. Phasellus malesuada in lorem eu tincidunt. Proin id egestas nibh. Quisque varius ante risus, eu sagittis nisl condimentum nec.
          Ut vestibulum lobortis velit, sit amet pharetra felis malesuada eu. Etiam neque nibh, blandit efficitur dolor eget, viverra semper tortor. Aenean sem turpis,
           bibendum a orci eget, tempor luctus turpis. Nunc erat felis, semper sed risus ultrices, pulvinar tincidunt ante. Aliquam dictum augue ut iaculis gravida.
            Nullam commodo vel nisi a congue. Sed nisl sapien, feugiat nec porttitor iaculis, elementum id justo. Donec sed vehicula ligula, at cursus nunc.
             In in orci porta, ultricies velit nec, porta arcu. ',
         'post_date' => '2020-03-05 17:57:00.000000', 'text' => 'Lorem ipsum']);
    }
}
