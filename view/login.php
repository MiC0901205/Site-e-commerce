<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="./css/login.css" media="screen" type="text/css"/>
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form  method="POST" action="./index.php?uc=login&action=validateConnexion">
                <h1>Connexion</h1>
                
                <label><b> Adresse mail</b></label>
                <input type="text" id="mail" placeholder="Entrer votre adresse mail" name="adresse_mail" required>
                
                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>
                <div id="errorConnexion" class="erreurConnexion">
                    <p>Adresse mail ou mot de passe incorrect</p>
                </div>
                <div id="inscription">
                    <a href="./index.php?uc=register&action=enregistrement">Pas de compte ?</a></br>
                </div>
                <input type="submit" name="connexion" id='submit' value='LOGIN' >
            </form>
        </div>
    </body>
    <script src="./js/login.js"></script>
</html>
