<h2>Statistiques inscriptions</h2>

<? foreach ($tournaments as $tournament): 

$state_reserve = 0;
$state_valide = 0;
$state_inscrit = 0;
$state_libre = 0;
$state_total = 0;
$state_max_slot = $tournament->getNumberTeam();
?>
<? foreach ($tournament->getTournamentSlot() as $slot):
    if ($slot->getStatus() == 'reserve'):
      $state_reserve++;
      $state_valide++;
      $state_inscrit++;
    elseif ($slot->getStatus() == 'valide'):
      $state_valide++;
      $state_inscrit++;
    elseif ($slot->getStatus() == 'inscrit'):
      $state_inscrit++;
    elseif ($slot->getStatus() == 'attente'):
      $state_inscrit++;
    elseif ($slot->getStatus() == 'libre'):
      $state_libre++;
    endif;
    $state_total++;
endforeach; ?>
<div style="width: 405px; float: left; margin: 5px 10px 10px 10px; background-color: #f2f2f2; border: solid 1px #ddd; padding: 10px;">
<div style="font-size: 14px; border-bottom: solid 1px #ddd; margin-bottom: 10px;"><?=image_tag('/uploads/jeux/icones/'.$tournament->getLogourl(), array('width' => '12'))?> <?=$tournament->getName()?></div>
<div style="text-shadow: 1px 1px 1px #000; font-size: 10px; text-transform: uppercase;">
  <div style="color: #fff; text-align: right; height: 15px; padding: 3px 0px 3px 0px; width: <?=(($state_reserve*100)/$state_max_slot)*4.1?>px; background: #47a1c6;">
    R&eacute;serv&eacute;s&nbsp;:&nbsp;<?=$state_reserve?>&nbsp;&nbsp;
  </div>
  <div style="color: #fff; text-align: right; height: 15px; padding: 3px 0px 3px 0px; width: <?=(($state_valide*100)/$state_max_slot)*4.1?>px; max-width: 410px; background: #3892b7;">
    Valid&eacute;s&nbsp;:&nbsp;<?=$state_valide?>&nbsp;&nbsp;
  </div>
  <div style="color: #fff; text-align: right; height: 15px; padding: 3px 0px 3px 0px; width: <?=(($state_inscrit*100)/$state_max_slot)*4.1?>px; max-width: 410px; background: #2c85aa;">
    Inscrits&nbsp;:&nbsp;<?=$state_inscrit?>&nbsp;&nbsp;
  </div>
  <div style="color: #fff; padding: 3px 0px 3px 0px; text-align: right; height: 15px; width: 410px; background-color: #55add1;">
    Total&nbsp;:&nbsp;<?=$state_max_slot?>&nbsp;&nbsp;
  </div>
</div>
<br/>
</div>

<? endforeach; ?>

<div style="clear: left;"></div>

<h3>D&eacute;tails</h3>

<?
$totalpayement = 0;
foreach ($slotsValid as $slot):
    $totalpayement+=$slot->getTournament()->getPlayerPerTeam()*$slot->getTournament()->getCostPerPlayer();
endforeach;
?>

<table class="table">
    <tr>
        <th>Nb utilisateurs</th>
        <td><?=count($users)?></td>
        <th>Nb joueurs</th>
        <td><?=count($players)?></td>
    </tr>
    <tr>
        <th>Nb &eacute;quipes</th>
        <td><?=count($teams)?></td>
        <th>Nb slots valid&eacute;s</th>
        <td><?=count($slotsValid)?></td>
    </tr>
    <tr>
        <th>Total paiements valid&eacute;s</th>
        <td><?=$totalpayement?> &euro;</td>
        <td></td>
        <td></td>
    </tr>
</table>

<table class="table">
    <?
    foreach ($tournaments as $tournament):
    ?>
        <tr>
            <th><?=$tournament->getName()?></th>
            <td>
                <?
                $nb['libre'] = 0;
                $nb['reserve'] = 0;
                $nb['attente'] = 0;
                $nb['inscrit'] = 0;
                $nb['valide'] = 0;
                $totalteam = 0;
                foreach ($tournament->getTournamentSlot() as $slot):
                    if ($slot->getStatus() != 'libre' && $slot->getStatus() != 'reserve'):
                        $totalteam++;
                    endif;
                    if ($slot->getStatus() == 'libre') $nb['libre']++;
                    if ($slot->getStatus() == 'reserve') $nb['reserve']++;
                    if ($slot->getStatus() == 'attente') $nb['attente']++;
                    if ($slot->getStatus() == 'inscrit') $nb['inscrit']++;
                    if ($slot->getStatus() == 'valide') $nb['valide']++;
                endforeach;
                ?>
                <?=$tournament->getNumberTeam()?> places pour <?=$totalteam?> &eacute;quipes<br/>
                <?=$nb['libre']?> libres, <?=$nb['reserve']?> r&eacute;serv&eacute;s, <?=$nb['inscrit']?> inscrits, <?=$nb['valide']?> valid&eacute;s, <?=$nb['attente']?> en attente
            </td>
        </tr>
    <?
    endforeach;
    ?>
</table>
