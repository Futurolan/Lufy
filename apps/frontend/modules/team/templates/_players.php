<td>
<?php
$i = '0';
foreach ($players as $player):
    $i++; ?>
    <a href="<?=url_for('user/view?username='.$player->getUsername())?>"><?=$player->getUsername();?></a>
    <? if (count($players) > $i){
    echo ' - ';
    };
    
endforeach;
?>
</td>