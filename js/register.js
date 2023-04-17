const eye = document.querySelector('.feather-eye');
const eyeoff = document.querySelector('feather-eye-off');
const passwordField = document.querySelector('input[type=password]');

function change() {
    eye.addEventListener('click', () => {
        eye.style.display = "none"; 
        eyeoff.style.display = "block";
        passwordField.type = "text";
    });

    eyeoff.addEventListener('click', () => {
        eye.style.display = "block"; 
        eyeoff.style.display = "none";
        passwordField.type = "password";
    });
}
