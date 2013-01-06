<div clas="box">
    <div class="content">
        <? include_component('partner', 'rolling')?>
    </div>
</div>

<div class="box">
    <div class="title"><?=__('Tournois')?></div>
    <div class="content">
        <i>&Agrave; venir...</i>
        <!--
        <div style="text-align: right;"><span class="button"><?=link_to('Voir les &eacute;quipes inscrites', 'tournament/list?slug=none')?></span></div>
        -->
        <?php /* include_component('tournament', 'nexttournament'); */?>
        <!--
        <?php //include_component('poker_tournament', 'list');?>
        -->

    </div>
</div>

<div class="box">
    <div class="content" style="text-align: center;">
        <?=link_to(image_tag('../css/gamersassembly/img/info-tarif.png'), 'page/view?slug=informations-pratiques-galloween-2012#tarifs') ?>
        <?=link_to(image_tag('../css/gamersassembly/img/info-transport.png'), 'page/view?slug=informations-pratiques-galloween-2012#plan') ?>
        <?=link_to(image_tag('../css/gamersassembly/img/info-hotel.png'), 'page/view?slug=informations-pratiques-galloween-2012#hotel') ?>
        <?=link_to(image_tag('../css/gamersassembly/img/info-restauration.png'), 'page/view?slug=informations-pratiques-galloween-2012#restauration') ?>
	<br/><br/>
        <?=link_to(image_tag('../css/gamersassembly/img/button-photos-videos.png'), 'gallery/index') ?>
        <br/>
        <?=link_to(image_tag('../css/gamersassembly/img/button-faq.png'), 'faq/index') ?>
        <br/>
        <?=link_to(image_tag('../css/gamersassembly/img/button-futurolan.png'), 'page/view?slug=decouvrez-l-association-futurolan') ?>
	<br/><br/>
	<a href="http://www.facebook.com/GamersAssembly" target="_blank"><?=image_tag('../css/gamersassembly/img/icone-facebook.jpg')?></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="https://twitter.com/GamersAssembly" target="_blank"><?=image_tag('../css/gamersassembly/img/icone-twitter.jpg')?></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="http://www.dailymotion.com/GamersAssembly" target="_blank"><?=image_tag('../css/gamersassembly/img/icone-dailymotion.jpg')?></a>
    </div>
</div>
