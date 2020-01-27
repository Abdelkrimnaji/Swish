// Permet de copier le lien injecté dans l'input text sur la page upload via le boutton
function copyLink() {
    let copyText = document.getElementById("inputLink");
    copyText.select();
    document.execCommand("copy");
    alert("Le lien a été copié dans le presse-papier !");
}