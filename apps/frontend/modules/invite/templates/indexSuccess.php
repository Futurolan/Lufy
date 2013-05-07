<div class="box">
	<div class="title">Invitations en cours</div>
        <div class="content">
	<?php foreach ($invites as $invite): ?>
		<?php if ($invite->getStatus() == 0 && $invite->getAction() == "join"):?>
			<b><?php echo $invite->getTeam('name') ?></b> vous invite dans son &eacute;quipe, souhaitez vous la rejoindre ? <?php echo link_to('Oui', 'invite/acceptPlayer?id='.$invite->getIdInvite())?> - <?php echo link_to('Non', 'invite/refusePlayer?id='.$invite->getIdInvite())?><br/>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php foreach ($friends as $friend): ?>
		<?php if ($friend->getStatus() == 0 && $friend->getAction() == "friend"):?>
			<b><?php echo $friend->SfGuardUser->first_name?> "<?php echo $friend->SfGuardUser->username?>" <?php echo substr($friend->SfGuardUser->first_name, 0, 1)?>.</b> vous invite &agrave; etre son ami(e) <?php echo link_to('Accepter', 'invite/acceptFriend?id='.$friend->getIdInvite())?> - <?php echo link_to('Refuser', 'invite/refuseFriend?id='.$friend->getIdInvite())?><br/>
		<?php endif; ?>
	<?php endforeach; ?>

	<?php if (count($invites) == 0 && count($friends) == 0): ?>
		<i><span class="grey">Vous n'avez aucune invitation actuellement.</span></i>
	<?php endif; ?>
    </div>
    <br/><br/>
    <div class="title">Historique</div>
    <div class="content">
        <?php foreach ($invites as $invite): ?>
		<?php if ($invite->getStatus() == 1 && $invite->getAction() == "join" && $invite->getResponse() == 'accept'):?>
			<?php echo $invite->getUpdatedAt() ?> - Vous avez rejoins l'&eacute;quipe <b><?php echo $invite->getTeam('name') ?></b>.<br/>
		<?php endif; ?>
                <?php if ($invite->getStatus() == 1 && $invite->getAction() == "join" && $invite->getResponse() == 'refuse'):?>
			<?php echo $invite->getUpdatedAt() ?> - Vous avez refus&eacute; l'invitation &agrave; rejoindre l'&eacute;quipe <b><?php echo $invite->getTeam('name') ?></b>.<br/>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php foreach ($friends as $friend): ?>
		<?php if ($friend->getStatus() == 1 && $friend->getAction() == "friend" && $friend->getResponse() == 'accept'):?>
			<?php echo $friend->getUpdatedAt() ?> - <b><?php echo $friend->SfGuardUser->first_name?> "<?php echo $friend->SfGuardUser->username?>" <?php echo substr($friend->SfGuardUser->first_name, 0, 1)?>.</b> est devenu votre ami.<br/>
		<?php endif; ?>
                <?php if ($friend->getStatus() == 1 && $friend->getAction() == "friend" && $friend->getResponse() == 'refuse'):?>
			<?php echo $friend->getUpdatedAt() ?> - Vous avez refus&eacute; la demande d'ami de <b><?php echo $friend->SfGuardUser->first_name?> "<?php echo $friend->SfGuardUser->username?>" <?php echo substr($friend->SfGuardUser->first_name, 0, 1)?>.</b>.<br/>
		<?php endif; ?>
	<?php endforeach; ?>
    </div>
</div>
