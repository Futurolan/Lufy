<div class="box">
    <h3><?=__('Liste des participants')?></h3>
    <?php foreach ($tournaments as $tournament): ?>
        <h4><?=image_tag('/uploads/jeux/icones/'.$tournament['logourl']); ?> <?=__('Tournoi')?> <?=$tournament['name'] ?></h4>
        <?php include_component('tournament_slot', 'team', array('idtournament' => $tournament['id_tournament'])) ?>
        <br/>
        <a href="<?= url_for('tournament/view?slug=' . $tournament['slug']) ?>" class="nmore"><?=__('Plus d informations sur le tournoi')?></a><br/>
    <? endforeach; ?>
</div>
    
