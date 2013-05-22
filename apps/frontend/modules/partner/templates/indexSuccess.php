<h2>Partenaires</h2>

<p>
    La Gamers Assembly ne pourrait exister sans le soutien de ses nombreux partenaires, dont certains sont fidèles maintenant depuis de longues années.
</p>
<p>
    Vous souhaitez sponsoriser un tournoi, exposer lors de notre manifestation ou simplement associer votre image &agrave; la notre ?
    Nous poss&egrave;dons de nombreuses solutions de communication et d'entraide afin de cr&eacute;er des collaborations "gagnant-gagnant".
    Contactez nous en d&eacute;crivant votre activit&eacute; et votre projet, nous nous engageons &agrave; revenir vers vous rapidement pour d&eacute;finir la mani&egrave;re dont nous pouvons travailler &agrave; vos c&ocirc;t&eacute;s !
</p>

<?php
$current_type = '';
foreach ($partners as $partner):
  if ($partner->getPartnerType()->getName() != $current_type):
    echo '<h3>'.$partner->getPartnerType()->getName().'</h3>';
  endif;
  ?>
  <div class="logo-partner" style="background-image: url('/uploads/partenaires/100/<?php echo $partner->getLogourl(); ?>');" data-location="<?php echo $partner->getWebsite(); ?>" data-toggle="tooltip"title="<?php echo $partner->getDescription(); ?>"></div>
  <?php
  $current_type = $partner->getPartnerType()->getName();
endforeach;
?>

<style>
.logo-partner {
  background-position: center center;
  background-repeat: no-repeat;
  display: inline-block;
  margin: 1px;
  padding: 15px;
  height: 100px;
  width: 100px;
  border: solid 1px #ccc;
  border-radius: 5px;
  box-shadow: 0px 0px 30px #ddd inset;
  transition: 0.5s;
  cursor: pointer;
}
.logo-partner:hover {
  box-shadow: 0px 0px 50px #bbb inset;
  transition: 0.5s;
}
</style>

<script>
$('.logo-partner').tooltip({
  'placement': 'right',
  'html': true
});
$('.logo-partner').bind('click', function() {
  window.open($(this).data('location'), '_blank');
});
</script>
