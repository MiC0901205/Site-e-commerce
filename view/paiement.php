
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Paiement en ligne - Peri-Flash</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/paiement.css">
</head>
<body>
<header>
    <h1>Paiement en ligne</h1>
</header>

<div class="container">
    <div class="row">
        <div class="col-sm-4"> <!-- Bloc des images des produits -->
            <div class="product-container">
                <?php
                $prixtot = 0;
                foreach ($_SESSION['panierListe']['produit'] as $id => $qte) {
                    if (!empty($id)) {
                        $Produit = ProduitRepository::selectProduitById($id);

                        $idProduit = $Produit->getId();
                        $prix = $Produit->getPrix();
                        $couleur = $Produit->getCouleur();
                        $image = $Produit->getImage();
                        $nom = $Produit->getNom();

                        $prixtot += $prix * $qte;

                        echo '<div class="product">
                                    <h4>'.$nom.'</h4>
                                    <img src="./img/'.$image.'"> 
                                    <p>Couleur: '.$couleur.'</p>
                                    <p>Prix: '.$prix.'€</p>
                                    <p>Quantité: '.$qte.'</p>
                                </div>';
                    } else {
                        echo "Il n'y a pas d'id correspondant à un produit";
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-sm-8"> <!-- Bloc du formulaire de paiement -->
            <div class="form-container">
                <form action="./index.php?uc=paiement&action=verifPaiement" method="POST">
                    <?php if(isset($_GET['error']) && $_GET['error'] == true) {
                        echo "<div class='alert alert-danger' role='alert'>
                                Un champ du formulaire n'a pas été rempli
                             </div>";
                    }
                    ?>
                    <div class="field">
                        <label for="nom-prenom">Titulaire de la carte</label>
                        <input type="text" id="nom-prenom" name="NP" placeholder="Entrer votre prénom et nom" value="<?php if(isset($_COOKIE['NP'])){ echo $_COOKIE['NP']; }?>">
                        <?php if (isset($errNP)): ?>
                            <div class="error"><?= $errNP ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="numero-carte">Numéro de carte</label>
                        <input type="text" id="numero-carte" name="CB" maxlength="16" placeholder="Entrer votre numéro de carte" value="<?php if(isset($_COOKIE['CB'])){ echo $_COOKIE['CB']; }?>">
                        <?php if (isset($errCB)): ?>
                            <div class="error"><?= $errCB ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="field">
                        <label>Date d'expiration</label>
                        <div class="date-expi">
                            <select name="Month" id="Month-select">
                                <option value="">Choisir le mois</option>
                                <option value="1">Janvier</option>
                                <option value="2">Février</option>
                                <option value="3">Mars</option>
                                <option value="4">Avril</option>
                                <option value="5">Mai</option>
                                <option value="6">Juin</option>
                                <option value="7">Juillet</option>
                                <option value="8">Aout</option>
                                <option value="9">Septembre</option>
                                <option value="10">Octobre</option>
                                <option value="11">Novembre</option>
                                <option value="12">Décembre</option>
                            </select>
                            <?php
                            if (isset($errMonth)){
                                ?>
                                <div class="errMessage"><?= $errMonth ?></div>
                            <?php  
                            }
                            ?>
                            <select class="<?php if(isset($errYear)){ echo "Messagebox"; }?>" name="Year" id="Year-select" value="<?php if(isset($_COOKIE['Year'])){ echo $_COOKIE['Year']; }?>">
                                <option value="">Choisir l'année</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <option value="2031">2031</option>
                                <option value="2032">2032</option>
                            </select>
                            <?php
                            if (isset($errYear)){
                                ?>
                                <div class="errMessage"><?= $errYear ?></div>
                            <?php  
                            }
                            ?>
                        </div>
                    </div>
                    <br/>
                    <label><b>Code de sécurité (CVV)</b></label>
                    <input type="text" class="<?php if(isset($errCV)){ echo "Messagebox"; }?>" placeholder="Entrer votre code de sécurité" name="CV" maxlength="3" minlength="3" value="<?php if(isset($_COOKIE['CV'])){ echo $_COOKIE['CV']; }?>">
                    <?php 
                    if (isset($errCV)){
                        ?>
                        <div class="errMessage"><?= $errCV ?></div>
                    <?php   
                    }
                    ?>
                    <div>
                        <?php
                        if(isset($_COOKIE['Souvenir']))
                        {
                            echo '<input type="checkbox" id="Souvenir" name="Souvenir" checked>';
                        } else {
                            echo '<input type="checkbox" id="Souvenir" name="Souvenir">';
                        }
                        ?>
                        <label for="Compte_achat">Se souvenir</label>
                    </div>
                    <div class="prix">
                        <p>Prix Total : <?php echo $prixtot ?> €</p>
                    </div>
                    <div class="button-wrapper">
                        <input type="submit" name="valid" id="Valider" value="Valider" class="button-full-width">
                        <a href="./index.php?uc=panier&action=panier"><input type="button" id="annuler" value="Annuler" class="button-full-width"></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>'