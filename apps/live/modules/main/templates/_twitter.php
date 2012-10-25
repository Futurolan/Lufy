<?php

function parse($text)
{
 $text = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $text);
 $text = preg_replace('#@([a-z0-9_]+)#i', '@<a href="http://twitter.com/$1">$1</a>', $text);
 $text = preg_replace('# \#([a-z0-9_-]+)#i', ' #<a href="http://search.twitter.com/search?q=%23$1">$1</a>', $text);
 return $text;
}

$user = "GamersAssembly"; /* Nom d'utilisateur sur Twitter */
$count = 7; /* Nombre de message à afficher */
$date_format = 'd M Y, H:i:s'; /* Format de la date à afficher */
$url = 'http://twitter.com/statuses/user_timeline/'.$user.'.xml?count='.$count;
$oXML = simplexml_load_file( $url );

foreach( $oXML->status as $oStatus )
{
 $datetime = date_create($oStatus->created_at);
 $date = date_format($datetime, $date_format)."\n";
 $text = str_replace('#GA ', ' ', $oStatus->text);
 echo '<p style=" font-size: 11px; padding: 5px;margin: 0px;border-bottom: solid 1px #e5e5e5;" class="hoverize">'.parse($text).'</p>';
// echo ' (<a href="http://twitter.com/'.$user.'/status/'.$oStatus->id.'">'.$date.'</a>)</li>';
}
?>

<p style="padding: 5px;text-align:right;">
    <?=link_to('&gt;&gt; Suivez nous sur Twitter', 'news/index')?>
</p>
