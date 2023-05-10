const eye = document.querySelectorAll('.feather-eye');
const eyeoff = document.querySelectorAll('.feather-eye-off');
const passwordField = document.querySelectorAll('input[type=password]');

for(let i = 0; i < eye.length; i++) {
    eye[i].addEventListener('click', () => {
        eye[i].style.display = "none";
        eyeoff[i].style.display = "block";
        passwordField[i].type = "text";
    });

    eyeoff[i].addEventListener('click', () => {
        eye[i].style.display = "block";
        eyeoff[i].style.display = "none";
        passwordField[i].type = "password";
    });
}

// sélectionne l'élément input pour le numéro de téléphone
const inputTelephone = document.querySelector('#telephone');

// ajoute un écouteur d'événements pour la saisie de l'utilisateur
inputTelephone.addEventListener('input', (event) => {
  // récupère la valeur saisie par l'utilisateur
  let telephone = event.target.value;
  
  // enlève tous les caractères qui ne sont pas des chiffres
  telephone = telephone.replace(/\D/g, '');
  
  // ajoute des espaces tous les 2 chiffres
  telephone = telephone.replace(/(\d{2})(?=\d)/g, '$1 ');
  
  // met à jour la valeur de l'élément input
  event.target.value = telephone;
});


document.getElementById("inscription")
    .addEventListener("click", function() {
    document.getElementById("mail").style.display = 'block';
    }, false);

if(error != null){
    $('#errorConnexion').show();
}

function checkPasswordStrength() {
    var password = document.getElementById('password').value;

    var strength = 0;
    var lengthDisplayed = false;
    var digitDisplayed = false;
    var uppercaseDisplayed = false;
    var specialDisplayed = false;


    // Vérification de la longueur du mot de passe
    if (password.length >= 8) {
        document.getElementById('password-indications').innerHTML = '';
        strength++;
    } else {
        document.getElementById('password-indications').innerHTML = 'Il faut au moins 8 caractères';
        lengthDisplayed = true;
    }

    // Vérification de la présence de chiffres
    if (/\d/.test(password)) {
        document.getElementById('password-indications').innerHTML = '';
        strength++;
    } else {
        if (!lengthDisplayed) {
            document.getElementById('password-indications').innerHTML = 'Il faut au moins un chiffre';
            digitDisplayed = true;
        }
    }

    // Vérification de la présence de lettres majuscules
    if (/[A-Z]/.test(password)) {
        document.getElementById('password-indications').innerHTML = '';
        strength++;
    } else {
        if (!lengthDisplayed && !digitDisplayed) {
            document.getElementById('password-indications').innerHTML = 'Il faut au moins une lettre majuscule';
            uppercaseDisplayed = true;
        }
    }

    // Vérification de la présence de caractères spéciaux
    if (/[^a-zA-Z0-9]/.test(password)) {
        document.getElementById('password-indications').innerHTML = '';
        strength++;
    } else {
        if (!lengthDisplayed && !digitDisplayed && !uppercaseDisplayed) {
            document.getElementById('password-indications').innerHTML = 'Il faut au moins un caractère spéciale';
            specialDisplayed = true;
        }
        if (!lengthDisplayed && !digitDisplayed && !uppercaseDisplayed && !specialDisplayed) {
            document.getElementById('password-indications').innerHTML = '';
            specialDisplayed = false;
        }
    }

    // Assigner une classe en fonction de la force du mot de passe
    var progressValue = (strength / 4) * 100;
    var progressBar = document.getElementById('password-strength-bar');
    progressBar.style.visibility = 'visible';
    progressBar.style.width = progressValue + '%';
    progressBar.className = '';

    switch (strength) {
        case 1:
            progressBar.classList.add('bar-weak');
            break;
        case 2:
            progressBar.classList.add('bar-medium');
            break;
        case 3:
            progressBar.classList.add('bar-strong');
            break;
        case 4:
            progressBar.classList.add('bar-very-strong');
            break;
        default:
            progressBar.classList.add('bar-weak');
    }

    document.getElementById('password-strength').innerHTML = message;
}

function clearPasswordIndications() {
    document.getElementById('password-indications').innerHTML = '';
}