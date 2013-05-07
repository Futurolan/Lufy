<table>
    <tbody>
        <?php foreach ($nexttournaments as $tournament): ?>    
            <tr>
                <td>
                <?php echo  image_tag('/uploads/jeux/icones/' . $tournament->getImage(), 'alt="' . $tournament->getName() . '"') ?>
            </td>
            <td>
                <?php echo  link_to($tournament->getName(), 'poker_tournament/view?slug=' . $tournament->getSlug()) ?><br /><i><?php echo  $tournament->getNumberSlot() ?> participants</i>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>