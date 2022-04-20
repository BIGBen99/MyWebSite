<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<table>
  <thead>
  <tr>
    <th>ID</th>
    <th>SIREN</th>
    <th>NIC</th>
    <th>SIRET</th>
    <th>Raison sociale</th>
    <th>isRoot</th>
    <th>ID du parent</th>
    <th>Adresse</th>
    <th>PND</th>
    <th>Date de création</th>
  </tr>
  <form method="post" action="?action=addEntity">
  <tr>
    <td></td>
    <td><input name="siren" type="text" placeholder="SIREN"></td>
    <td><input name="numeroInternedeClassement" type="text" placeholder="NIC"></td>
    <td></td>
    <td><input name="name" type="text" placeholder="Raison sociale"></td>
    <td></td>
    <td><input name="parent_id" type="text" placeholder="ID parent"></td> <!-- à remplacer par un select -->
    <td><input name="address_line1" type="text" placeholder="ligne 1"></td>
    <td><input type="submit"></td>
  </tr>
  </form>
  </thead>
  <tbody>
<?php
foreach ($entities as $entity):
?>
  <tr>
    <td><?= $entity['id'] ?></td>
    <td><?= $entity['siren'] ?></td>
    <td><?= $entity['numeroInternedeClassement'] ?></td>
    <td><?= !is_null($entity['numeroInternedeClassement'])?$entity['siren'] . $entity['numeroInternedeClassement']:'' ?></td>
    <td><?= $entity['name'] ?></td>
    <td><?= is_null($entity['parent_id'])?'X':'' ?></td>
    <td><?= !is_null($entity['parent_id'])?$entity['parent_id']:'' ?></td>
    <td><?= $entity['address_line1'] ?>, <?= $entity['address_line2'] ?>, <?= $entity['address_line3'] ?>, <?= $entity['address_zipCode'] ?> <?= $entity['address_city'] ?>, <?= $entity['address_country'] ?></td>
    <td><?= $entity['address_pliNonDistribuable'] > 0?'X':'' ?></td>
    <td><?= $entity['creation_date'] ?></td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
