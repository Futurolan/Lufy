<?php use_javascript('slimbox.js') ?>
<?php use_javascript('jquery-picasa.js') ?>
<?php use_stylesheet('slimbox.css') ?>

<h2><?php echo __('Photos'); ?> <?php echo $gallery->getTitle()?></h2>

<div id="mygallery">Chargement en cours...</div>


<script>
$(document).ready(function() {
  $("#mygallery").EmbedPicasaGallery('futurolan',{
    albumid: "<?php echo $gallery->album_id?>",
    size:      '128',
    msg_loading_list :  'Loading list from PicasaWeb',
    msg_back :   'Back'
  });
});
</script>
