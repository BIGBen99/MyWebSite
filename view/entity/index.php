<?php $this->title = 'Mon blog - Liste des entités'; ?>

<form method="post" action="/entity/addEntity">
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
  </thead>
  <tbody>
<?php
foreach ($entities as $entity):
?>
  <tr>
    <td><?= $this->clean($entity['id']) ?></td>
    <td><?= $this->clean($entity['siren']) ?></td>
    <td><?= $this->clean($entity['numeroInternedeClassement']) ?></td>
    <td><?= !is_null($entity['numeroInternedeClassement'])?$this->clean($entity['siren'] . $entity['numeroInternedeClassement']):'' ?></td>
    <td><?= $this->clean($entity['name']) ?></td>
    <td><?= is_null($entity['parent_id'])?'X':'' ?></td>
    <td><?= !is_null($entity['parent_id'])?$this->clean($entity['parent_id']):'' ?></td>
    <td><?= $this->clean($entity['address_line1']) ?>, <?= $this->clean($entity['address_line2']) ?>, <?= $this->clean($entity['address_line3']) ?>, <?= $this->clean($entity['address_zipCode']) ?> <?= $this->clean($entity['address_city']) ?>, <?= $this->clean($entity['address_country']) ?></td>
    <td><?= $entity['address_pliNonDistribuable'] > 0?'X':'' ?></td>
    <td><?= $this->clean($entity['creation_date']) ?></td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
</form>
