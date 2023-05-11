var dureeBlocageMinutes = 5;
var connexionButton = document.getElementById('submit');
var compteurElement = document.getElementById('compteur');
var alerte = document.getElementById('alerte');

function reafficherBoutonConnexion() {
  if (connexionButton) {
    connexionButton.disabled = false;
    alerte.style.display = 'none';
  }
}

function mettreAJourCompteur() {
    var debutBlocage = localStorage.getItem('debutBlocage');
    var dureeEcoulée = localStorage.getItem('dureeEcoulée');

    if (compteurElement && debutBlocage) {
        var maintenant = new Date().getTime();
        var tempsEcoule = maintenant - debutBlocage;
        if (dureeEcoulée) {
        tempsEcoule += parseInt(dureeEcoulée);
        }
        var tempsRestant = dureeBlocageMinutes * 60 * 1000 - tempsEcoule;

        if (tempsRestant > 0) {
        var minutes = Math.floor(tempsRestant / (60 * 1000));
        var secondes = Math.floor((tempsRestant % (60 * 1000)) / 1000);

        compteurElement.textContent = "Temps restant : " + minutes + " minutes " + secondes + " secondes";

        setTimeout(mettreAJourCompteur, 1000);
        } else {
        reafficherBoutonConnexion();
        localStorage.removeItem('debutBlocage');
        localStorage.removeItem('dureeEcoulée');
        alerte.style.display = 'none';
        compteurElement.textContent = "";
        }
    } else {
        reafficherBoutonConnexion();
    }
}

function enregistrerDureeEcoulée() {
  var debutBlocage = localStorage.getItem('debutBlocage');
  if (debutBlocage) {
    var maintenant = new Date().getTime();
    var tempsEcoule = maintenant - debutBlocage;
    localStorage.setItem('dureeEcoulée', tempsEcoule.toString());
  }
}

var urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('connexion') && urlParams.get('connexion') === 'blocked') {
  if (connexionButton) {
    connexionButton.disabled = true;
  }

  alerte.style.display = 'block';
  var debutBlocage = localStorage.getItem('debutBlocage');
  if (!debutBlocage) {
    localStorage.setItem('debutBlocage', new Date().getTime());
  }

  mettreAJourCompteur();
}

window.addEventListener('unload', enregistrerDureeEcoulée);
window.addEventListener('beforeunload', enregistrerDureeEcoulée);