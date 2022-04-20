<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<table>
  <tr><td>ID</td><td>SIREN</td><td>NIC</td><td>SIRET</td><td>Raison sociale</td><td>Adresse</td><td>PND</td><td>Date de création</td></tr>
<?php
foreach ($entities as $entity):
?>
  <tr>
    <td><?= $entity['id'] ?></td>
    <td><?= $entity['siren'] ?></td>
    <td><?= $entity['numeroInternedeClassement'] ?></td>
    <td><?= !is_null($entity['numeroInternedeClassement'])?$entity['siren'] . $entity['numeroInternedeClassement']:"" ?></td>
    <td><?= $entity['name'] ?></td>
    <td></td>
    <td><?= $entity['address_pliNonDistribuable']?"X":"" ?></td>
    <td><?= $entity['creation_date'] ?></td>
  </tr>
<?php endforeach; ?>
</table>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
