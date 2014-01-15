<h2>Administration</h2>

<p> Bienvenue sur l'interface d'administration du site www.gamers-assembly.net.
<br /><br />
Si vous rencontrez un probl&egrave;me sur l'ensemble du site, ou bien des remarques,
n'h&eacute;sitez pas &agrave; en faire part sur l'adresse email webmaster@futurolan.net.
</p>
<br/><br/>

<div style="width: 48%; float: left;">
    <h3>Statistiques</h3>
    <ul>
        <li><?=$nb_news?> actualit&eacute;s publi&eacute;es</li>
        <li><?=$nb_pages?> pages r&eacute;dig&eacute;es</li>
        <li><?=$nb_partners?> partenaires</li>
        <li><?=$nb_users?> comptes utilisateurs</li>
    </ul>
</div>

<div style="clear: left;"></div>


<h3>Tableau de bord</h3>

<div>
    <div class="icone"><a href="<?=url_for('news/index')?>"><?=image_tag('/css/img/backend/32news.png')?> <br /> News</a></div>
    <div class="icone"><a href="<?=url_for('page/index')?>"><?=image_tag('/css/img/backend/32page.png')?> <br /> Pages</a></div>
    <div class="icone"><a href="<?=url_for('block/index')?>"><?=image_tag('/css/img/backend/32block.png')?> <br /> Encarts</a></div>
    <div class="icone"><a href="<?=url_for('partner/index')?>"><?=image_tag('/css/img/backend/32partner.png')?> <br /> Partenaires</a></div>
    <div class="icone"><a href="<?=url_for('file/index')?>"><?=image_tag('/css/img/backend/32video.png')?> <br /> Vid&eacute;os</a></div>
    <div class="icone"><a href="<?=url_for('faq/index')?>"><?=image_tag('/css/img/backend/32faq.png')?> <br /> F.A.Q.</a></div>
    <div style="clear:left;"></div>
</div>

<div>
    <div class="icone"><a href="<?=url_for('player/index')?>"><?=image_tag('/css/img/backend/32player.png')?> <br /> Joueurs</a></div>
    <div class="icone"><a href="<?=url_for('team/index')?>"><?=image_tag('/css/img/backend/32team.png')?> <br /> Equipes</a></div>
    <div class="icone"><a href="#"><?=image_tag('/css/img/backend/32stat.png')?> <br /> Statistiques</a></div>
    <div class="icone"><a href="<?=url_for('ipn/index')?>"><?=image_tag('/css/img/backend/32paypal.png')?><br />Logs Paypal</a></div>
    <div style="clear:left;"></div>
</div>

<div>
    <div class="icone"><a href="<?=url_for('tournament_slot/index')?>"><?=image_tag('/css/img/backend/32tournament.png')?> <br /> Tournois</a></div>
    <div class="icone"><a href="<?=url_for('poker_tournament/index')?>"><?=image_tag('/css/img/backend/32poker.png')?> <br /> Poker</a></div>
    <div class="icone"><a href="<?=url_for('event/index')?>"><?=image_tag('/css/img/backend/32event.png')?> <br /> Evenements</a></div>
    <div class="icone"><a href="<?=url_for('game/index')?>"><?=image_tag('/css/img/backend/32game.png')?> <br /> Jeux</a></div>
    <div class="icone"><a href="<?=url_for('main/parameters')?>"><?=image_tag('/css/img/backend/32configuration.png')?> <br /> Configuration</a></div>
    <div style="clear:left;"></div>
</div>
