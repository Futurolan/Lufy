<div class="row-fluid">
  <div class="span2">
    <img src="/uploads/event/logo/<?=$event->getImage()?>" />
  </div>
  <div class="span10">
    <h2><?php echo $event->getName()?></h2>
    <p style="font-size: 16px; color: #999;">
      <?php echo $event->getDescription()?>
    </p>
  </div>
</div>


<br/><br/>

<? if ($page): ?>
  <h3><i class="icon-info-sign"></i> <?=__('Informations')?></h3>
  <div class="row-fluid">
    <?=$page->getContent(ESC_RAW)?>
  </div>

  <div style="text-align: right;">
    <?=link_to(__('Plus de details sur notre page informations pratiques'), 'page/view?slug=informations-pratiques', array('class' => 'btn btn-small btn-default'))?>
  </div>

  <br/><br/>
<? endif; ?>



<div class="row-fluid">
  <div class="span4">
    <h3><i class="icon-home"></i> <?=__('Nous trouver')?></h3>
    <?=nl2br($event->getAddress())?>

    <br/><br/>

    <h3><i class="icon-time"></i> <?=__('Dates')?></h3>
    <?=__('Ouverture de l\'evenement')?> :<br/>
    <?=format_date($event->getStartAt(), 'dd MMMM yyyy')?> <?=__('au')?> <?=format_date($event->getEndAt(), 'dd MMMM yyyy')?>
    <br/><br/>
    <?=__('Ouverture des inscriptions')?> :<br/>
    <?=format_date($event->getStartRegistrationAt(), 'dd MMMM yyyy')?> <?=__('au')?> <?=format_date($event->getEndRegistrationAt(), 'dd MMMM yyyy')?>
  </div>
  <div class="span8">
    <iframe src="<?=$event->getMapUrl()?>" width="100%" height="320" frameborder="0" border="0"></iframe>
  </div>
</div>


<br/><br/>


<? if ($event->getTournament()->count() > 0): ?>
<h3><i class="icon-star"></i> <?=__('Tournois')?></h3>
<div class="row-fluid event-tournaments">
  <ul>
  <? foreach ($event->getTournament() as $tournament): ?>
    <li>
      <img src="/uploads/jeux/icones/<?=$tournament->getLogourl()?>" /> <?=link_to($tournament->getName(), 'tournament/view?slug='.$tournament->getSlug())?>
    </li>
  <? endforeach; ?>
  </ul>
</div>
<? endif; ?>


<style>
.event-tournaments ul li {
  display: inline-block;
  margin: 0px 3% 10px 0px;
  width: 30%;
}
</style>
