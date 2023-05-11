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

const inputTelephone = document.querySelector('#telephone');

inputTelephone.addEventListener('input', (event) => {
  let telephone = event.target.value;
  
  telephone = telephone.replace(/\D/g, '');
  
  telephone = telephone.replace(/(\d{2})(?=\d)/g, '$1 ');
  
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

    var passwordIndications = document.getElementById('password-indications');
    var infoIcon = document.querySelector('.info-icon');

    if (password.length >= 8) {
        passwordIndications.innerHTML = '';
        strength++;
    } else {
        passwordIndications.innerHTML = "Veuillez inclure au moins 8 caractères.";
        lengthDisplayed = true;
    }

    if (/\d/.test(password)) {
        strength++;
    } else {
        if (!lengthDisplayed) {
            passwordIndications.innerHTML = "Veuillez inclure au moins un chiffre.";
            digitDisplayed = true;
        }
    }

    if (/[A-Z]/.test(password)) {
        strength++;
    } else {
        if (!lengthDisplayed && !digitDisplayed) {
            passwordIndications.innerHTML = "Veuillez inclure au moins une majuscule.";
            uppercaseDisplayed = true;
        }
    }

    if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
        strength++;
    } else {
        if (!lengthDisplayed && !digitDisplayed && !uppercaseDisplayed) {
            passwordIndications.innerHTML = "Veuillez inclure au moins un caractère spécial.";
            specialDisplayed = true;
        }
    }

    if (lengthDisplayed || digitDisplayed || uppercaseDisplayed || specialDisplayed) {
        infoIcon.style.display = 'inline-block';
    } else {
        infoIcon.style.display = 'none';
    }

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
}

function clearPasswordIndications() {
    document.getElementById('password-indications').innerHTML = '';
    document.querySelector('.info-icon').style.display = 'none';
}