<?php if ($data['allrss'] === null): ?>
    <section>
        <p class="pError"> Erreur : l'affichage de la liste des trois derniers épisodes n'est pas possible. </p>
    </section>
<?php elseif ($data['allrss'] !== null): ?>
    <section>
        <h2>Flux du Rss </h2>

        <?php foreach($data['allrss'] as $rss): ?>
                <article>
                    <h3>Épisode <?=$rss['title']?></h3>
                    <p><?=$rss['introduction']?></p>
                    <p class="pCreatedAt">Publié <?=$rss['post_date']?> </p>
                    
                    <p><?=$rss['link']?></p>
                    <p><?=$rss['date_item']?></p>
                    <p><?=$rss['website_origin']?></p>
                    <p><?=$rss['website_url']?></p>
                    <p><?=$rss['post_date']?></p>
                </article>
                <a class="list-group-item" href="'.$link.'" target="_blank">
                    <h5 class="list-group-item-heading">'.$title.'<br><small>'.$date.'</small></h5>
                    <p class="list-group-item-text">'.$description.'</p>
                </a>
    </section>
    <?php endforeach; ?>
<?php endif; ?>