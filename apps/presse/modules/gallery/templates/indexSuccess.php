<div class="box">
  <div class="title">Galeries photos & vid&eacute;os</div>
  <div class="content">
    <div style="float: left; width: 520px; margin-right: 25px;">
      <div class="subtitle">Photos</div>
      <? foreach ($gallerys as $gallery): ?>
        <ul class="gallery-box" style="width: 240px; margin-right: 10px; float: left;">
          <li class="gallery-title"><?=link_to($gallery->getTitle(), 'gallery/view?slug='.$gallery->getSlug()) ?></li>
          <li class="gallery-content" style="font-size: 12px; font-style: italic;"><?php echo $gallery->getDescription() ?></li>
        </ul>
      <? endforeach; ?>
      <ul style="clear: left;"></ul>
    </div>

    <div style="float: left; width: 230px; margin-left: 25px;">
      <div class="subtitle">Vid&eacute;os</div>
        <? include_component('file', 'videos') ?>
    </div>

    <div style="clear: left;"></div>
  </div>
</div>

<? slot('filename'); ?>
        <? echo 'Galeries photos & vid&eacute;os'; ?>
<? end_slot(); ?>
