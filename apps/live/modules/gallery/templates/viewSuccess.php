<? use_javascript('slimbox.js') ?>
<? use_javascript('jquery-picasa.js') ?>
<? use_stylesheet('slimbox.css') ?>

<div class="box">
    <div class="title"><?=$gallery->getTitle()?></div>
    <div class="content">
        <div id="mygallery"></div>

<script>
$(document).ready(function() {
$("#mygallery").EmbedPicasaGallery('futurolan',{
  albumid: "<?=$gallery->album_id?>",
  size:      '128',  // thumb size (32,48,64,72,144,160))
  msg_loading_list :  'Loading list from PicasaWeb',
  msg_back :   'Back'
 });
});
</script>

    </div>
</div>
