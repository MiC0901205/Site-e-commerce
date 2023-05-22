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
            let isDelete = confirm("Etes-vous sûr de vouloir supprimer ce type ?");
            if (isDelete) {
                location.replace('./index.php?uc=admin&action=supprimerType&idType=' + id);
            } else {
                location.replace('./index.php?uc=admin&action=adminType&suppr=false');
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



