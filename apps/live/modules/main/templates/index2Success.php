<div class="box" style="width: 400px; float:left;">
    <div class="title">En direct de la Gamers Assembly</div>
    <div class="content">
        <iframe frameborder="0" width="400" height="250" src="http://www.dailymotion.com/embed/video/xhfom6"></iframe>
    </div>
</div>

<div class="box" style="width: 320px; float:left;">
    <div class="title">Nous sommes aussi sur...</div>
    <div class="content">
        <a href="#" border="0"><?php echo image_tag('../uploads/encarts-special/millenium.png')?></a>
        <a href="#" border="0"><?php echo image_tag('../uploads/encarts-special/frequence3.png')?></a>
    </div>
</div>
<div style="clear: left;"></div>

<div class="box" style="width: 400px; float:left;">
    <div class="title"><?php echo __('Actualite')?></div>
    <div class="content">
        <?php include_component('news', 'actualitelight'); ?>
    </div>
</div>

<div class="box" style="width: 320px; float:left;">
    <div class="title">Flux Twitter</div>
    <div class="content">
        <?php  include_partial('twitter'); ?>
    </div>
</div>
<div style="clear: left;"></div>
