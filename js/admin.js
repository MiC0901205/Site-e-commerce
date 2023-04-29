// Récupérer la sélection de l'utilisateur
var selectedBatterie = document.getElementById("batterie").value;

// Récupérer tous les produits
var produits = document.getElementsByClassName("produit");

// Parcourir tous les produits et les cacher s'ils ne correspondent pas à la sélection de l'utilisateur
for (var i = 0; i < produits.length; i++) {
  var produit = produits[i];
  var batterie = produit.getElementsByClassName("batterie")[0].textContent;
  if (selectedBatterie && batterie !== selectedBatterie) {
    produit.style.display = "none";
  } else {
    produit.style.display = "flex";
  }
}





