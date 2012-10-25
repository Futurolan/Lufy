<h2>Statistiques Google Analytic</h2>

<table class="table">
  <tr>
    <th>Semaines</th>
    <th>Visites</th>
  </tr>
  <?php
  foreach($ga->getResults() as $result):
  ?>
  <tr>
    <td>Semaine <?php echo $result ?></td>
    <td><?php echo $result->getVisits() ?></td>
  </tr>
  <?php
  endforeach
  ?>
</table>
Soit <b><?php echo $ga->getVisits() ?></b> vistes sur <?php echo $ga->getTotalResults() ?> semaines