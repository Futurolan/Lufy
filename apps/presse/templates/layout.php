<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
<div id="header">
    <div style="width: 1100px; margin: auto auto;">
	<div>
	    <?=link_to('Presse & Partenaires', '@homepage', array('style' => 'color: #0195bb;'))?>
	</div>
    </div>
</div>

<div id="Page">
  <div id="sidebar" style="float: left;">
    <ul>
      <li><?=link_to('Accueil', '@homepage')?></li>
      <li><?=link_to('Pr&eacute;sentation', 'page/view?slug=presentation')?></li>
      <li><?=link_to('Devenir partenaire', 'page/view?slug=devenir-partenaire')?></li>
      <li><?=link_to('Reporting et presse', 'page/view?slug=communiques')?></li>
      <li><?=link_to('Galeries photos & vid&eacute;os', 'gallery/index')?></li>
      <li><?=link_to('Logoth&egrave;que', 'page/view?slug=logotheque')?></li>
      <li><?=link_to('Contact', 'page/view?slug=contact')?></li>
      <li></li>
<!--      <li><a href="http://www.gamers-assembly.net/fr">Gamers Assembly - Site officiel</a></li>-->
    </ul>
    <div style="margin-left: 10px;">
      Retrouvez nous aussi sur...<br/><br/>
      <a href="http://www.facebook.com/GamersAssembly" target="_blank"><?=image_tag('icone-facebook.jpg', array('width' => 50))?></a>
      &nbsp;&nbsp;
      <a href="https://twitter.com/GamersAssembly" target="_blank"><?=image_tag('icone-twitter.jpg', array('width' => 50))?></a>
      &nbsp;&nbsp;
      <a href="http://www.dailymotion.com/gamersassembly" target="_blank"><?=image_tag('icone-dailymotion.jpg', array('width' => 50))?></a>
    </div>
  </div>

  <div id="container" style="float: left;">
    <?php echo $sf_content ?>
  </div>

  <div style="clear: left;"></div>
</div>



	<div id="footer">
		Association Futurolan - 
		11, rue Paul Gauvin - 
		86280 Saint Benoit - 
		contact@futurolan.net
	</div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-7594737-10']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

  </body>
</html>
