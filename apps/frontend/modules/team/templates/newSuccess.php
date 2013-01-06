<div class="box">
    <div class="title"><?=__('Creer une equipe')?></div>
    <div class="content">

    <div class="flashbox info">
        <?=__('Attention, un joueur peut appartenir a une seule equipe. Si un autre membre a deja cree une équipe vous devez lui demander de vous inviter a la rejoindre.')?>
    </div>

    <?php include_partial('form', array('form' => $form)) ?>
    </div>
</div>
