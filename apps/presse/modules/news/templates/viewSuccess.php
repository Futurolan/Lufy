<?php use_helper('bb') ?>
<?php use_helper('Date') ?>

<div class="box">
  <div class="title"><?php echo link_to('Actualit&eacute;s', 'news/index')?> - <?php echo ucfirst($news->getTitle())?></div>
  <div class="content">
    <?php echo bb_parse($news->getContent())?>
    <div style="font-size: 12px; color: grey; border-top: solid 1px #aaa; text-align: right; margin-top: 40px;">
      Publi&eacute; le <?php echo format_date($news->getPublishOn(), 'dd/MM/yyy')?> par <?php echo $news->getSfGuardUser()->getFirstName().' '.$news->getSfGuardUser()->getLastName()?>
    </div>
  </div>
</div>
