<div id="myCarousel" class="carousel slide">
  <ol class="carousel-indicators">
    <?php $i = 0; ?>
    <?php foreach($affiches as $affiche):?>
      <?php if ($i == 0): ?>
        <?php $active = 'class="active"'; ?>
      <?php else: ?>
        <?php $active = ''; ?>
      <?php endif; ?>
      <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php echo $active; ?>></li>
      <?php $i++; ?>
    <?php endforeach; ?>

  </ol>

  <div class="carousel-inner">
    <?php $i = 0; ?>
    <?php foreach($affiches as $affiche):?>
      <?php if ($i == 0): ?>
        <?php $active = 'active'; ?>
      <?php else: ?>
        <?php $active = ''; ?>
      <?php endif; ?>
      <div class="item <?php echo $active; ?>">
        <?php echo image_tag('/uploads/news/affiche/'.$affiche->getImage(), array('width' => '100%')) ?>
        <div class="carousel-caption">
          <p><?php echo link_to($affiche->getTitle(), '@news_view?slug='.$affiche->getSlug()); ?></p>
        </div>
      </div>
      <?php $i++; ?>
    <?php endforeach; ?>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('.carousel').carousel({
    interval: 4000
  })
});
</script>

