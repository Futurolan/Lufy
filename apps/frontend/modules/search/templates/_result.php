<?php if ($records->count()): ?>
  <table cellspacing="0" cellpadding="0" class="profil1">
    <?php foreach ($records as $record): ?>
      <tr>
        <td style="width: 60px;"><?php if ($record->logourl) { echo '<img src="'.$record->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
        <td>
          <?php echo image_tag('/css/img/flag/'.$record->country.'.gif', array('height' => '15px'))?>  <?php echo link_to($record->username, 'user/view?username='.$record->username) ?><br/>
          <i>(<?php echo  $record->getFirstName() ?> <?php echo substr($record->getLastName(), 0, 1);?>.)</i>
        </td>
      </tr>
    <?php endforeach ?>
  </table>
<?php else: ?>
  <a class="quiet">Aucun résultat.</p>
<?php endif ?>
<br/>
<?php echo link_to('Relancer une nouvelle recherche', 'search/user', array('class' => 'button'))?>