<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
    $("#slideshow").slideshow({
        pauseSeconds: 4,
        height: 135,
        width: 720,
        border: 0,
        caption: false
    })
});
</script>

<div id="slideshow">
    <?php foreach($affiches as $affiche):?>
        <a href="<?php echo url_for('news/view?slug='.$affiche->getSlug())?>">
            <?php echo image_tag('/uploads/news/affiche/'.$affiche->getImage(), 'alt="'.$affiche->getTitle().'" title="'.$affiche->getTitle().'" class="logo"') ?>
        </a>
    <?php endforeach; ?>
</div>
