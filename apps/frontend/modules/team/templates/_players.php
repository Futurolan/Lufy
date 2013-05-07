<td>
<?php
$i = '0';
foreach ($players as $player):
    $i++; ?>
    <a href="<?php echo url_for('user/view?username='.$player->getUsername())?>"><?php echo $player->getUsername();?></a>
    <?php if (count($players) > $i){
    echo ' - ';
    };
    
endforeach;
?>
</td>