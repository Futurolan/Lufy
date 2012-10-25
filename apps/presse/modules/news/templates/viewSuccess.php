<? use_helper('bb') ?>
<? use_helper('Date') ?>

<div class="box">
  <div class="title"><?=link_to('Actualit&eacute;s', 'news/index')?> - <?=ucfirst($news->getTitle())?></div>
  <div class="content">
    <?=bb_parse($news->getContent())?>
    <div style="font-size: 12px; color: grey; border-top: solid 1px #aaa; text-align: right; margin-top: 40px;">
      Publi&eacute; le <?=format_date($news->getPublishOn(), 'dd/MM/yyy')?> par <?=$news->getSfGuardUser()->getFirstName().' '.$news->getSfGuardUser()->getLastName()?>
    </div>
  </div>
</div>
