<div class="box">
    <div class="content">

<div class="title">Devenir partenaire ?</div>
<p>
    La Gamers Assembly ne pourrait exister sans le soutien de ses nombreux partenaires, dont certains sont fidèles maintenant depuis de longues années.
</p>
<p>
    Vous souhaitez sponsoriser un tournoi, exposer lors de notre manifestation ou simplement associer votre image &agrave; la notre ?
    Nous poss&egrave;dons de nombreuses solutions de communication et d'entraide afin de cr&eacute;er des collaborations "gagnant-gagnant". 
    Contactez nous en d&eacute;crivant votre activit&eacute; et votre projet, nous nous engageons &agrave; revenir vers vous rapidement pour d&eacute;finir la mani&egrave;re dont nous pouvons travailler &agrave; vos c&ocirc;t&eacute;s !
</p>
<?php

foreach ($partners as $partner):
  if ($partner->PartnerType->status == 1):
    $var[] = array($partner->PartnerType->position, $partner->PartnerType->name, $partner->getWebsite(), $partner->getLogourl(), $partner->getName(), $partner->getDescription());
  endif;
endforeach;

$result = count($var);
$currentType = 0;

$nb_cols = 5;
$j = 0;
?>
<table width="100%">
<?php for ($i=0;$i<$result;$i++)
{
  if ($j == $nb_cols):
    echo "</tr>";
    $j = 0;
  endif;
  if ($currentType != $var[$i][0]): ?>
    <?php $j = 0; ?>
    <tr><td colspan="<?php echo $nb_cols?>"><div class="title"><?php echo $var[$i][1]?></div></td></tr><tr>
  <?php endif; 
  
  if ($j == 0) echo "<tr>";?>
  <td valign="middle" align="center" style="text-align: center;"><a href="<?php echo $var[$i][2]?>"><?php echo image_tag('/uploads/partenaires/100/'.$var[$i][3], 'class="partnerLogo" alt="'.$var[$i][4].'" title="'.$var[$i][5].'"')?></a></td>
  
  <?php $currentType = $var[$i][0]; ?>
  <?php $j++; ?>
  <?php if ($i == $result-1) echo "</tr>";?>
<?php } ?>
</table>
    </div>
</div>
