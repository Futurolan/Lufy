<div class="box">
    <h3>Mes Amis</h3>




    <? if (count($friends) == 0): ?>
        <i><span class="grey">Vous n'avez pas d'amis actuellement.</span></i>
    <? else: ?>
        <p>Liste d'amis:<p/>
        <ul>
        <?php foreach ($friends as $friend): ?>
            <li>
            <?= $friend->getSfGuardUser()->getUsername() ?>
            </li>
        <?php endforeach; ?>
        </ul>
     <? endif; ?>
</div>