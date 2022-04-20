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
    <td><?= $entity['address_line1'] ?>, <?= $entity['address_line2'] ?>, <?= $entity['address_line3'] ?>, <?= $entity['address_zipcode'] ?> <?= $entity['address_city'] ?>, <?= $entity['address_country'] ?></td>
    <td><?= $entity['address_pliNonDistribuable'] ?></td>
    <td><?= $entity['creation_date'] ?></td>
  </tr>
<?php endforeach; ?>
</table>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
