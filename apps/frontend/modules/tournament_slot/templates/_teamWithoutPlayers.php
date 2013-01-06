<table class="listteam" cellspacing="0" cellpadding="0">
<tr>
<td style="height: 10px; width: 10px;border: 1px solid #000000;" class="status_libre">&nbsp;</td>
<td style="height: 10px; width: 50px;">libre</td>
<td style="height: 10px; width: 10px;border: 1px solid #000000;" class="status_attente">&nbsp;</td>
<td style="height: 10px; width: 50px;">en attente</td>
<td style="height: 10px; width: 10px;border: 1px solid #000000;" class="status_inscrit">&nbsp;</td>
<td style="height: 10px; width: 50px;">inscrit</td>
<td style="height: 10px; width: 10px;border: 1px solid #000000;" class="status_valide">&nbsp;</td>
<td style="height: 10px; width: 50px;">valid&eacute;</td>
<td style="height: 10px; width: 10px;border: 1px solid #000000;" class="status_reserve">&nbsp;</td>
<td style="height: 10px; width: 50px;">r&eacute;serv&eacute;</td>
</tr>
</table>
<table class="listteam" cellspacing="0" cellpadding="5">
    <tr>
        <th>#</th>
        <th><?=__('Nom de l equipe')?></th>
    </tr>
    <? $i = '0'; ?>
    <?php foreach ($slots as $slot): ?>
    <? $i++ ?>
    <? if ($i == $attente): ?>
        <tr>
            <th colspan="3"><?=__('Debut de la liste d attente')?></th>
        </tr>
    <? endif ?>
        
        <tr class="status_<?=$slot->getStatus(); ?>">
            <td><?= $slot->getPosition() ?></td>
            <td><? if (!$slot->getTeamId()): ?><?= $slot->getStatus() ?>
            <? else: ?>
                <b><?= link_to($slot->TeamName($slot->getTeamId()), 'team/view?slug=' . $slot->TeamSlug($slot->getTeamId())); ?></b>
                </td>
        <? endif; ?>
        </tr>
    <? endforeach; ?>
</table>