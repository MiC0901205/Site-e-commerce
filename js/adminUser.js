const selectRole = document.getElementById("selectRole");
selectRole.addEventListener("change", function() {
    const role = this.value;
    const utilisateurs = document.querySelectorAll("tbody tr");

    utilisateurs.forEach(function(utilisateur) {
        const roleUtilisateur = utilisateur.querySelector("td:nth-child(10)").textContent.trim();

        if (role === "" || role === roleUtilisateur) {
            utilisateur.style.display = "table-row";
        } else {
            utilisateur.style.display = "none";
        }
    });
});

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

function updateButtons() {
    var checkedCount = 0;
    var checkboxes = document.querySelectorAll('input[type=checkbox]');
    var id = 0;
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            checkedCount++;
            id = checkboxes[i].id

            for (var j = 0; j < checkboxes.length; j++) {
                if (checkboxes[j].checked && j != i) {
                    checkboxes[j].checked = false;
                    break;

                }
            }
            break;
        }
    }
    var deleteButton = document.getElementById('delete-button');
    var editButton = document.getElementById('edit-button');
    if (checkedCount > 0) {
        deleteButton.disabled = false;
        editButton.disabled = false;
        editButton.style.backgroundColor = 'green';
        deleteButton.style.backgroundColor = 'red';
        editButton.style.borderColor = 'green';
        deleteButton.style.borderColor = 'red';
        deleteButton.onclick = () => {
            checkboxes[i].checked = false;
            let isDelete = confirm("Etes-vous sûr de vouloir supprimer l'utilisateur ?");
            if (isDelete) {
                location.replace('./index.php?uc=admin&action=supprimerUser&id=' + id);
            } else {
                location.replace('./index.php?uc=admin&action=adminUser&suppr=false');
            }
        };
        editButton.onclick = () => {
            checkboxes[i].checked = false;
            location.replace('./index.php?uc=admin&action=infoType&id='+ id +'');
        };
    } else {
        deleteButton.disabled = true;
        editButton.disabled = true;
        editButton.style.backgroundColor = 'grey';
        deleteButton.style.backgroundColor = 'grey';
        editButton.style.borderColor = 'grey';
        deleteButton.style.borderColor = 'grey';
    }
}
