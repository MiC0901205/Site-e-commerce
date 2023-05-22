<?php
include 'navbar.php';
?>
<div class="alert alert-success" role="alert">
  Votre commande a été validé et est référencé à l'id <?php echo $idCommande; ?>
</div>
</br>
<a href="./index.php?uc=infoClient&action=historique" class="btn-historique" style="margin-left: 2%;">Voir votre historique </a>
