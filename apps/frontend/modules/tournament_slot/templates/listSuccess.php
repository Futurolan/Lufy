<div class="box">
    <h3><?php echo __('Liste des participants')?></h3>
    <?php foreach ($tournaments as $tournament): ?>
        <h4><?php echo image_tag('/uploads/jeux/icones/'.$tournament['logourl']); ?> <?php echo __('Tournoi')?> <?php echo $tournament['name'] ?></h4>
        <?php include_component('tournament_slot', 'team', array('idtournament' => $tournament['id_tournament'])) ?>
        <br/>
        <a href="<?php echo  url_for('tournament/view?slug=' . $tournament['slug']) ?>" class="nmore"><?php echo __('Plus d informations sur le tournoi')?></a><br/>
    <?php endforeach; ?>
</div>
    
