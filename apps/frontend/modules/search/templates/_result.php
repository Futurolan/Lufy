<? if ($records->count()): ?>
  <table cellspacing="0" cellpadding="0" class="profil1">
    <? foreach ($records as $record): ?>
      <tr>
        <td style="width: 60px;"><? if ($record->logourl) { echo '<img src="'.$record->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
        <td>
          <?=image_tag('/css/img/flag/'.$record->country.'.gif', array('height' => '15px'))?>  <?=link_to($record->username, 'user/view?username='.$record->username) ?><br/>
          <i>(<?= $record->getFirstName() ?> <?=substr($record->getLastName(), 0, 1);?>.)</i>
        </td>
      </tr>
    <? endforeach ?>
  </table>
<? else: ?>
  <p class="quiet">Aucun résultat.</p>
<? endif ?>
<br/>
<?=link_to('Relancer une nouvelle recherche', 'search/user', array('class' => 'button'))?>