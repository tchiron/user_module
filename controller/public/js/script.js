"use strict";

function form_validate() {
    document.getElementById("error_fn").textContent = '';
    document.getElementById("error_ln").textContent = '';
    let prenom = document.getElementById("first_name").value;
    let nom = document.getElementById("last_name").value;
    if (!prenom || !nom) {
        if (!prenom) {
            document.getElementById("error_fn").textContent = 'prenom pas glop';
        }
        if (!nom) {
            document.getElementById("error_ln").textContent = 'nom pas glop';
        }
        return false;
    }
    return true;
}