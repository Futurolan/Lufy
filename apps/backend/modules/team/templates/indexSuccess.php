<h2>Equipes</h2>

<div id="toolbox">
<?=ajax_link('Ajouter une &eacute;quipe', 'team/new', array('class' => 'button add'))?>
</div>

<table class="table" style="width: 620px; float: left;"">
  <thead>
    <tr>
      <th>&Eacute;quipes</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <? foreach ($teams as $team): ?>
    <tr>
      <td><?=$team->getName() ?></td>
      <td>
        <?=ajax_link('D&eacute;tails', 'team/view?id_team='.$team->getIdTeam(), array('class' => 'button small'))?>
        <?=ajax_link('Modifier', 'team/edit?id_team='.$team->getIdTeam(), array('class' => 'button small'))?>
      </td>
    </tr>
    <? endforeach; ?>
  </tbody>
<tfoot>
<tr>
<td colspan="2">
</td></tr>
</tfoot>
</table>

<form action="<?=url_for('team/filter')?>" method="POST">
  <table class="table" width="300" style="width: 250px; float: left; margin-left: 30px;">
    <tr>
      <th colspan="2">Rechercher une &eacute;quipe</th>
    </tr>
    <?=$form?>
    <tr>
      <td colspan="2" align="right"><input class="button" type="submit" value="Rechercher"/></td>
    </tr>
</table>
</form>

<div style="clear: left;"></div>

<div class="pager" style="width: 620px; text-align: center;">
    <span class="page"><?=ajax_link('<<', 'team/index?page='.$teams->getFirstPage())?></span>
    <? foreach ($teams->getLinks(10) as $page) echo ($page == ' '.$teams->getPage()) ? ' <span class="current">'.$page : '</span> <span class="page">'.ajax_link($page, 'team/index?page='.$page)?>
    <span class="page"><?=ajax_link('>>', 'team/index?page='.$teams->getLastPage())?></span>
</div>
