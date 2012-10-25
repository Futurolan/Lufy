<td>
<?php
$i = '0';
foreach ($players as $player):
    $i++; ?>
    <?=$player->getUsername();?>
    <? if (count($players) > $i){
    echo ' - ';
    };
    
endforeach;
?>
</td>
