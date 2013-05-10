<ul>
  <?php $i = 0; ?>
  <?php $j = 0; ?>
  <?php foreach ($partners as $partner): ?>
    <?php if ($i == 0): ?>
      <ul id="rolling-<?php echo $j?>" class="rolling-partner" style="list-style-type: none; height: 155px; width: 220px;">
        <li style="width: 220px; text-align: center;line-height:100px;"><?php echo image_tag('/uploads/partenaires/150/'.$partner->getLogourl())?></li>
      </ul>
      <?php $j++; ?>
    <?php elseif ($i != 0 && $i % 2 != 0): ?>
      <ul id="rolling-<?php echo $j?>" class="rolling-partner" style="list-style-type: none; height: 155px; width: 220px;">
        <li style="float: left; width: 110px; text-align: center;line-height:110px;"><?php echo image_tag('/uploads/partenaires/100/'.$partner->getLogourl())?></li>
    <?php elseif ($i != 0 && $i % 2 == 0): ?>
        <li style="float:left; width: 110px; text-align: center;line-height:110px;"><?php echo image_tag('/uploads/partenaires/100/'.$partner->getLogourl())?></li>
        <li style="clear:left;"></li>
      </ul>
      <?php $j++; ?>
    <?php endif; ?>

    <?php $i++; ?>
  <?php endforeach; ?>
</ul>

<script>
$(document).ready(function() {
$(".rolling-partner").hide();
var max = <?php echo $j?>;
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
