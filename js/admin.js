// Filtrage par type de batterie
const selectTypeBatterie = document.getElementById("typeProduit")
selectTypeBatterie.addEventListener("change", function() {
    const typeProduit = this.value;
    const produits = document.querySelectorAll("tbody tr");

    produits.forEach(function(produit) {
    const typeBatterieProduit = produit.querySelector("td:nth-child(8)").textContent;

    if (typeProduit === "" || typeProduit === typeBatterieProduit) {
        produit.style.display = "table-row";
    } else {
        produit.style.display = "none";
    }
    });
});

function updateButtons() {
    var checkedCount = 0;
    var checkboxes = document.querySelectorAll('input[type=checkbox]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            checkedCount++;
            for (var j = 0; j < checkboxes.length; j++) {
                if (j !== i) {
                    checkboxes[j].checked = false;
                }
            }
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
    } else {
        deleteButton.disabled = true;
        editButton.disabled = true;
        editButton.style.backgroundColor = 'grey';
        deleteButton.style.backgroundColor = 'grey';
        editButton.style.borderColor = 'grey';
        deleteButton.style.borderColor = 'grey';
    }
}

var deleteButton = document.getElementById('delete-button');
deleteButton.onclick = function() {
    let isDelete = confirm("Etes-vous sûr de vouloir supprimer ce produit ?");

}    



