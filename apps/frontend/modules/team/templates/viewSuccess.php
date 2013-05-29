<h2><?php echo __('Fiche equipe')?></h2>

<h3><?php echo $team->getName()?></h3>
<table class="table">
  <tr>
    <td align="center" valign="top" rowspan="5" width="200">
      <img src="<?php echo $team->getLogourl(); ?>" width="200" />
    </td>
    <td><?php echo __('Team')?></td>
    <td><?php echo  $team->getName() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Tag')?></td>
    <td><?php echo  $team->getTag() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Cree le')?></td>
    <td><?php echo  $team->getCreatedAt() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Site web')?></td>
    <td><?php echo  $team->getWebsite() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Description')?></td>
    <td><?php echo  $team->getdescription() ?></td>
  </tr>
</table>
<?php
  if ($isCaptain)
  {
    include_partial('playersAdmin', array('team' => $team));
  }
  else
  {
    include_partial('players', array('team' => $team));
  }
?>

