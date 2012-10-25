<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$("#slideshow").slideshow({
                pauseSeconds: 4,
                height: 120,
                width: 710,
                caption: false
            })
		});
</script>
<div id="slideshow">
          <?php foreach($affiches as $affiche):?>
            <a href="<?=url_for('news/view?slug='.$affiche->getSlug())?>">
              <?=image_tag('/uploads/news/affiche/'.$affiche->getImage(), 'alt="'.$affiche->getTitle().'" title="'.$affiche->getTitle().'" class="logo"') ?>
            </a>
          <? endforeach; ?>
</div>
