<?php $title = 'Mon blog'; ?>

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
    <td><input name="siren" type="text" placeholder="SIREN" size="9"></td>
    <td><input name="numeroInternedeClassement" type="text" placeholder="NIC" size="5"></td>
    <td></td>
    <td><input name="name" type="text" placeholder="Raison sociale"></td>
    <td></td>
    <td><input name="parent_id" type="text" placeholder="ID parent" size="5"></td> <!-- à remplacer par un select -->
    <td><input name="address_line1" type="text" placeholder="ligne 1"><br><input name="address_line2" type="text" placeholder="ligne 2"><br><input name="address_line3" type="text" placeholder="ligne 3"><br><input name="address_zipCode" type="text" placeholder="Code postal" size="7"><input name="address_city" type="text" placeholder="Ville" size="13"><br><input name="address_country" type="text" placeholder="Pays"><br></td>
    <td><input name="address_pliNonDistribuable" type="checkbox"></td>
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
