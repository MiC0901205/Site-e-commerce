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
