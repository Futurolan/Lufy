<div class="box">
    <h3>Liste des tournois poker</h3>
    <br/>
    <?php foreach ($poker_tournaments as $poker_tournament): ?>
    <div style="margin-top: 10px; margin-bottom: 10px;">
    <h4><a href="<?php echo url_for('poker_tournament/view?slug='.$poker_tournament->getSlug()) ?>"><?php echo $poker_tournament->getName() ?></a></h4>
    <?php echo $poker_tournament->getDescription() ?>
    </div>
    <br/>
    <?php endforeach; ?>
    <br/>
    <div style="width: 600px; margin: auto auto;"><a href="http://www.arjel.fr/" target="_blank"><?=image_tag('mention-poker.png')?></a></div>
</div>