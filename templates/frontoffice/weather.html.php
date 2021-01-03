
<section>
    <h2>Météo à <?=$data['location']?></h2>
    <?php foreach($data['allweather'] as $post): ?>
                <article>
                    <h3>Lieu <?=$post['location']?></h3>
                    <h3>Actuel <?=$post['current']?></h3>
                    <h3>Température <?=$post['temperature']?></h3>
                </article>
    </section>
    <?php endforeach; ?>
    <p></p>
</section>
