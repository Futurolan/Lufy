<? use_javascript('slimbox.js') ?>
<? use_javascript('jquery-picasa.js') ?>
<? use_stylesheet('slimbox.css') ?>

<div class="box">
    <div class="title"><?=link_to('Galeries photos', 'gallery/index')?> - <?=$gallery->getTitle()?></div>
    <div class="content" style="margin: auto auto;">
        <div id="mygallery" style="width: 770px; margin: auto auto;"></div>

<script>
$(document).ready(function() {
$("#mygallery").EmbedPicasaGallery('futurolan',{
  albumid: "<?=$gallery->album_id?>",
  size:      '144',  // thumb size (32,48,64,72,144,160))
  msg_loading_list :  'Loading list from PicasaWeb',
  msg_back :   'Back'
 });
});
</script>

    </div>
</div>

<? slot('filename'); ?>
        <? echo 'Galeries photos & vid&eacute;os'; ?>
<? end_slot(); ?>
