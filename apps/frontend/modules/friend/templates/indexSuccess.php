<div class="box">
    <h3>Mes Amis</h3>




    <?php if (count($friends) == 0): ?>
        <i><span class="grey">Vous n'avez pas d'amis actuellement.</span></i>
    <?php else: ?>
        <p>Liste d'amis:<p/>
        <ul>
        <?php foreach ($friends as $friend): ?>
            <li>
            <?php echo  $friend->getSfGuardUser()->getUsername() ?>
            </li>
        <?php endforeach; ?>
        </ul>
     <?php endif; ?>
</div>