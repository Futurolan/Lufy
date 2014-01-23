<h2><?php echo __('Inscription')?></h2>

<div class="row-fluid">
  <div class="span3 tournament-box" onclick="showDetail(1);">
    <div class="tournament-step">1</div>
    <div class="tournament-info">Achetez vos billets</div>
  </div>
  <div class="span3 tournament-box" onclick="showDetail(2);">
    <div class="tournament-step">2</div>
    <div class="tournament-info">Vérifiez votre profil</div>
  </div>
  <div class="span3 tournament-box" onclick="showDetail(3);">
    <div class="tournament-step">3</div>
    <div class="tournament-info">Composez votre équipe</div>
  </div>
  <div class="span3 tournament-box" onclick="showDetail(4);">
    <div class="tournament-step">4</div>
    <div class="tournament-info">Validez votre inscription</div>
  </div>
</div>

<ul>
<? foreach ($steps as $key=>$value): ?>
<li><?=$key?> : <?=($value) ? 'success' : 'fail' ?></li>
<? endforeach; ?>
</ul>
 
<div class="tournament-detail">
   <div class="tournament-detail-1">
    <h3>Etape 1 - Achetez vos billets</h3>
    <ul>
      <li>Achetez vos billets sur notre billetterie Weezevent (1 paiement par équipe)</li>
      <li>Envoyez les billets à vos joueurs et saisissez vos numéros de billets et de commande sur votre espace perso</li>
    </ul>
  </div>
  <div class="tournament-detail-2">
    <h3>Etape 2 - Vérifiez votre profil</h3>
    <ul>
      <li>Vérifiez votre profil personnel, chaque joueur doit compléter toutes les informations qui lui sont demandées</li>
      <li>Renseignez une adresse de livraison dans le cas où nous aurions des lots à vous envoyer après l\'évènement</li>
    </ul>
  </div>
  <div class="tournament-detail-3">
    <h3>Etape 3 - Composez votre équipe</h3>
    <ul>
      <li>Votre manager doit créer une équipe et inviter les joueurs qui la compose</li>
      <li>Les joueurs qui participent aux tournois doivent avoir le statut de "joueur" dans l'équipe</li>
      <li>Les "managers" (non joueur) ou "membre non joueur" ne seront pas pris en compte</li>
    </ul>
  </div>
  <div class="tournament-detail-4">
    <h3>Etape 4 - Validez votre inscription</h3>
    <ul>
      <li>Une fois toutes les étapes précédentes réalisées, l'inscription de votre équipe sera validée dans les 48h</li>
    </ul>
  </div>
</div>


<style>
.tournament-detail h3 {
  margin-top: 0px;
  color: #333;
  border-bottom: solid 1px #ddd;
  font-size: 10px;
  font-weight: normal;
}

.tournament-box {
  margin-top: 20px;
  padding: 30px 0px 20px 0px;
  background: #f0f0f0;
  border: solid 1px #ddd;
}

.tournament-step {
  font-size: 48px;
  color: #ccc;
  text-align: center;
  margin-bottom: 20px;
}

.tournament-info {
  font-size: 11px;
  color: #333;
  text-transform: uppercase;
  text-align: center;
}

.tournament-detail {
  margin-top: 20px;
  padding: 10px;
  background: #f0f0f0;
  border: solid 1px #ddd;
  display: none;
}

.tournament-detail div {
  display: none;
}
</style>

<script>
function showDetail(step) {
  $('.tournament-detail').children().hide();
  $('.tournament-detail-'+step).show();
  $('.tournament-detail').show();
}
</script>