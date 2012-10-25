<ul>
  <? $i = 0; ?>
  <? $j = 0; ?>
  <? foreach ($partners as $partner): ?>
    <? if ($i == 0): ?>
      <ul id="rolling-<?=$j?>" class="rolling-partner" style="list-style-type: none; height: 155px; width: 220px;">
        <li style="width: 220px; text-align: center;line-height:100px;"><?=image_tag('/uploads/partenaires/150/'.$partner->getLogourl())?></li>
      </ul>
      <? $j++; ?>
    <? elseif ($i != 0 && $i % 2 != 0): ?>
      <ul id="rolling-<?=$j?>" class="rolling-partner" style="list-style-type: none; height: 155px; width: 220px;">
        <li style="float: left; width: 110px; text-align: center;line-height:110px;"><?=image_tag('/uploads/partenaires/100/'.$partner->getLogourl())?></li>
    <? elseif ($i != 0 && $i % 2 == 0): ?>
        <li style="float:left; width: 110px; text-align: center;line-height:110px;"><?=image_tag('/uploads/partenaires/100/'.$partner->getLogourl())?></li>
        <li style="clear:left;"></li>
      </ul>
      <? $j++; ?>
    <? endif; ?>

    <? $i++; ?>
  <? endforeach; ?>
</ul>

<script>
$(document).ready(function() {
$(".rolling-partner").hide();
var max = <?=$j?>;
var min = 0;
var i = 0;

function rolling(min, max, i) {
  if (i == max) {
    i = min;
  }

  $(".rolling-partner").hide();
  $("#rolling-"+i).fadeIn(200);
  i++;
  setTimeout(function(){
    rolling(min, max, i);
  },  3000);
}

rolling(min, max, i);

});
</script>
<br/>
