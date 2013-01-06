<ul>
<? if ($sf_user->isAuthenticated()): ?>
        <li><?=link_to(image_tag('13/house.png').' '.$sf_user->getUsername(), 'user/index')?> <?php include_component('invite', 'nbinvite') ?></li>
<!--    <li><?=link_to(image_tag('13/group.png').' '.__('Mon équipe'), 'team/index')?></li>
-->
        <li><?=link_to(image_tag('13/star.png').' '.__('Mon inscription'), 'tournament_slot/index')?></li>

        <li><?=link_to(image_tag('13/key.png').' '.__('Deconnexion').' &nbsp;', 'sfGuardAuth/signout')?></li>
<? else: ?>
        <li><?=link_to(image_tag('13/key.png').' '.__('Connexion'), 'sfGuardAuth/signin')?></li>
        <li><?=link_to(image_tag('13/user.png').' '.__('Créer un compte'), 'sfGuardRegister/index')?></li>
<? endif; ?>
<? include_component('main', 'changeCulture')?>
</ul>
