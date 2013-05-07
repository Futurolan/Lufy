<td>
<?php
$i = '0';
foreach ($players as $player):
    $i++; ?>
    <?php echo $player->getUsername();?>
    <?php if (count($players) > $i){
    echo ' - ';
    };
    
endforeach;
?>
</td>
