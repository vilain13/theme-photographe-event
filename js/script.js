console.log("bonjour JS");

// Gestion de la modale de Contact
let modal = document.getElementById('myModal');
let linkContact = document.getElementById("menu-item-53");
let imgModal = document.getElementsByClassName("imgModale")[0];

linkContact.onclick = function() {
    modal.style.display = "block";
};

imgModal.onclick = function() {
    modal.style.display = "none";
};

