<!-- Template normal -->

<div class="box">
    <div class="content">
        <?php  include_component('news', 'affiche'); ?>
    </div>
</div>

<div class="box">
    <div class="title"><?php echo __('Actualite')?></div>
    <div class="content">
        <?php include_component('news', 'actualite'); ?>
    </div>
</div>

<!-- /Template normal -->


<!-- Template Light + Twitter --

<div class="box" style="float: left; width: 440px;">
    <div class="title">Stream</div>
    <div class="content">
      <div style="display: block; width: 440px; height: 260px;background: #000;"></div>
    </div>
</div>

<div class="box" style="float: left; width: 250px;">
    <div class="title">R&eacute;sultats des tournois</div>
    <div class="content">

    </div>
</div>

<div class="box" style="float: left; width: 440px;">
    <div class="title"><?php echo __('Actualite')?></div>
    <div class="content">
        <?php include_component('news', 'actualitelight'); ?>
    </div>
</div>

<div class="box" style="float: left; width: 250px;">
    <div class="title"><?php echo __('Flux Twitter')?></div>
    <div class="content">
        <?php  include_partial('twitter'); ?>
    </div>
</div>

<div style="clear: left;"></div>

<!-- /Template light + Twitter -->

<div class="box"style="width: 340px;float:left;">
    <div class="title"><?php echo __('Galeries Dailymotion')?></div>
    <div class="content">
	<div id="DMWidget" style="width: 450px;"><script type="text/javascript" src="http://publishers.dailymotion.com/widgets/widgets.js?type=carousel&filters=creative-official&channel=videogames&user=GamersAssembly&limit=16"></script></div>
    </div>
</div>
<div class="box" style="width: 350px;float:left;">
    <div class="title">Informations</div>
    <div class="content">
        <?php include_component('block', 'list'); ?>
    </div>
</div>
<div style="clear: left;"></div>
