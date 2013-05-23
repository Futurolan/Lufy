<h2>Ticket > Suivis du ticket #<?php echo $ticket->getId(); ?></h2>

<div style="margin-bottom: 10px;">
  <?php foreach ($ticket->getFlags() as $flag): ?>
    <span style="background-color: #<?php echo $flag->getColor(); ?>; padding: 2px 5px 2px 5px; border-radius: 5px; color: #fff; font-weight: bold; text-shadow: 0px 0px 1px #000;"><?php echo $flag->getName(); ?></span>
  <?php endforeach; ?>
</div>

<div style="background-color: #fffae8; border: solid 1px #fbce32; padding: 0px 10px 0px 10px;">
  <p style="font-size: 14px; font-weight: bold;">#<?php echo $ticket->getId(); ?> <?php echo $ticket->getTitle(); ?></p>
  <p><?php echo $ticket->getContent(); ?></p>
  <p style="text-align: right; font-size: 11px;">Post&eacute; par <?php echo $ticket->getSfGuardUser(); ?> le <?php echo $ticket->getCreatedAt(); ?></p>
</div>

<?php foreach ($replys as $reply): ?>
  <div style="border-bottom: solid 1px #ccc; margin-top: 0px; padding: 5px 10px 5px 10px;">
    <p style="font-size: 14px; font-weight: bold;">#<?php echo $reply->getId(); ?> <?php echo $reply->getTitle(); ?></p>
    <p><?php echo $reply->getContent(); ?></p>
    <p style="text-align: right; font-size: 11px;">Post&eacute; par <?php echo $reply->getSfGuardUser(); ?> le <?php echo $reply->getCreatedAt(); ?></p>
  </div>
<?php endforeach; ?>
