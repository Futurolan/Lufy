<div class="box">
	<div class="title">Invitations en cours</div>
        <div class="content">
	<?php foreach ($invites as $invite): ?>
		<? if ($invite->getStatus() == 0 && $invite->getAction() == "join"):?>
			<b><?=$invite->getTeam('name') ?></b> vous invite dans son &eacute;quipe, souhaitez vous la rejoindre ? <?=link_to('Oui', 'invite/acceptPlayer?id='.$invite->getIdInvite())?> - <?=link_to('Non', 'invite/refusePlayer?id='.$invite->getIdInvite())?><br/>
		<? endif; ?>
	<?php endforeach; ?>
	<?php foreach ($friends as $friend): ?>
		<? if ($friend->getStatus() == 0 && $friend->getAction() == "friend"):?>
			<b><?=$friend->SfGuardUser->first_name?> "<?=$friend->SfGuardUser->username?>" <?=substr($friend->SfGuardUser->first_name, 0, 1)?>.</b> vous invite &agrave; etre son ami(e) <?=link_to('Accepter', 'invite/acceptFriend?id='.$friend->getIdInvite())?> - <?=link_to('Refuser', 'invite/refuseFriend?id='.$friend->getIdInvite())?><br/>
		<? endif; ?>
	<?php endforeach; ?>

	<? if (count($invites) == 0 && count($friends) == 0): ?>
		<i><span class="grey">Vous n'avez aucune invitation actuellement.</span></i>
	<? endif; ?>
    </div>
    <br/><br/>
    <div class="title">Historique</div>
    <div class="content">
        <?php foreach ($invites as $invite): ?>
		<? if ($invite->getStatus() == 1 && $invite->getAction() == "join" && $invite->getResponse() == 'accept'):?>
			<?=$invite->getUpdatedAt() ?> - Vous avez rejoins l'&eacute;quipe <b><?=$invite->getTeam('name') ?></b>.<br/>
		<? endif; ?>
                <? if ($invite->getStatus() == 1 && $invite->getAction() == "join" && $invite->getResponse() == 'refuse'):?>
			<?=$invite->getUpdatedAt() ?> - Vous avez refus&eacute; l'invitation &agrave; rejoindre l'&eacute;quipe <b><?=$invite->getTeam('name') ?></b>.<br/>
		<? endif; ?>
	<?php endforeach; ?>
	<?php foreach ($friends as $friend): ?>
		<? if ($friend->getStatus() == 1 && $friend->getAction() == "friend" && $friend->getResponse() == 'accept'):?>
			<?=$friend->getUpdatedAt() ?> - <b><?=$friend->SfGuardUser->first_name?> "<?=$friend->SfGuardUser->username?>" <?=substr($friend->SfGuardUser->first_name, 0, 1)?>.</b> est devenu votre ami.<br/>
		<? endif; ?>
                <? if ($friend->getStatus() == 1 && $friend->getAction() == "friend" && $friend->getResponse() == 'refuse'):?>
			<?=$friend->getUpdatedAt() ?> - Vous avez refus&eacute; la demande d'ami de <b><?=$friend->SfGuardUser->first_name?> "<?=$friend->SfGuardUser->username?>" <?=substr($friend->SfGuardUser->first_name, 0, 1)?>.</b>.<br/>
		<? endif; ?>
	<?php endforeach; ?>
    </div>
</div>
