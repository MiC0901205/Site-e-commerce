<html>
    <head>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <meta charset="utf-8">
      <!-- importer le fichier de style -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" href="../css/authentification.css" media="screen" type="text/css"/>
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            <div id="compteur" style=" color:white;"></div>

            <div id="alerte" class="alert alert-danger connexion-blocked" role="alert" style="display:none;">
              La connexion est bloquée en raison du nombre d'essais de connexion échoués. Veuillez patienter...
            </div>
            <form  method="POST" action="./index.php?uc=login&action=validateConnexion">
                <h1>Connexion</h1>
                <?php  
                    if(isset($_GET['mail_confirm'])) {
                      $mail_confirm = $_GET['mail_confirm'];
                      if($mail_confirm == true) {
                        echo '<div class="alert alert-success" role="alert">
                                Votre adresse mail a bien été confirmée
                            </div>';
                      } else {
                        echo '
                          <div class="alert alert-warning" role="alert">
                            Votre adresse mail n\'a pas été confirmée
                          </div>
                        ';
                      }
                    }  
                    if(isset($_GET['error'])){
                      echo '<div class="alert alert-danger" role="alert">
                        Votre mot de passe ou adresse mail est incorrecte
                        </div>';        
                    } 
                    if(isset($_GET['out']) && $_GET['out'] == 'redirect') {
                      echo '<div class="alert alert-danger" role="alert">
                        Vous devez vous connecter pour voir votre panier
                        </div>';
                    }

                    
                    ?>
                  <label><b>Adresse mail</b></label>
                    <input type="text" id="mail" placeholder="Entrer votre adresse mail" name="adresse_mail" style="width:325px;" value="<?php if(isset($_GET['login']) && (!empty($_GET['login']))){ echo $_GET['login']; }?>" required>
                    <label class="password_label"><b>Mot de passe</b>
                      <input class="psw" type="password" placeholder="Mot de passe*" name="mdp" required>
                        <div class="password-icon">
                            <i data-feather="eye" class="eye"></i>
                            <i data-feather="eye-off" class="eyeOff"></i>
                        </div>
                    </label>

                    <!-- script JS icon -->
                    <script src="https://unpkg.com/feather-icons"></script>
                    <script>
                        feather.replace();
                    </script>

                    <div id="errorConnexion" class="erreurConnexion">
                    <p>Adresse mail ou mot de passe incorrect</p>
                    </div>

                    <div id="inscription">
                    <a href="./index.php?uc=register&action=enregistrement">Pas de compte ?</a><br>
                    </div>
                    <input type="submit" name="connexion" id="submit" value="LOGIN">
                    <?php if(isset($_GET['connexion']) && $_GET['connexion'] == 'blocked') {
                        echo "<a href='#'><input class='btn btn-secondary annuler' type='button' value='Annuler authentification'/></a>";
                    } else {
                      echo "<a href='../index.php?uc=accueil' id='annuler'><input class='btn btn-secondary annuler' type='button' value='Annuler authentification'/></a>";
                    }
                    ?>     
            </form>
            <script src="../js/authentification.js"></script>
            <script src="../js/verifLog.js"></script>
        </div>
    </body>
</html>
