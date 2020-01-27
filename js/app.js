let input = document.getElementById('file-input');
let infoArea = document.getElementById('file-upload-filename');
const imgUpload = document.querySelector('.imgUpload');
const myButton = document.querySelector('.myButton');
const receive = document.getElementsByName('receiver-mail[]');
let i;
let correct = false;

input.addEventListener('change', showFileName);

// Permet l'affichage des fichiers insérés avec leurs infos (nom, taille, extention)
function showFileName(event) {
    // Fait disparaitre l'image d'upload
    imgUpload.style.display = 'none';

    correct = true;

    for (i = 0; i < input.files.length; i++) {
        let input = event.srcElement;
        // Affiche le nom des fichiers insérés
        let fileName = input.files[i].name;
        // Affiche la taille des fichiers insérés
        let fileSize = input.files[i].size;
        // Converti octets en ko
        fileSize = Math.round(fileSize / 1000);
        // Récupère l'extention du fichier
        let getExt = fileName.split('.').pop();
        // Injecte les infos récupérés dans la div ciblé
        infoArea.innerHTML += '<p class="files_content d-block mx-auto">' + fileName + '</p>';
        infoArea.innerHTML += '<p class="files_attribute d-block mx-auto">' + fileSize + ' ko' + ' | ' + getExt + '</p>';

        verifSize();
        verifExt();
    }
}

myButton.addEventListener('click', verifInputValue);

function verifInputValue() {
    // Si la valeur de l'input n'est pas défini -> Retourne une alerte
    if (!correct) {
        swal("Attention !", "Merci d'ajouter vos fichiers avant d'envoyer !", "warning");
    }
    console.log(receive);
}

function verifSize() {
    if (input.files[i].size > 5000000) {
        Swal({
            title: "Erreur !",
            type: "error",
            text: "Vous avez dépassé la limite maximal de 5 Mo",
            confirmButtonClass: "reloadPage",
            confirmButtonText: "Recommencer",
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        })
    }
}

let filesExt = ['.css', '.csv', '.doc', '.docx', '.gif', '.html', '.ico', '.jpeg', '.jpg', '.mp3', '.mp4', '.mpeg', '.mpg', '.odp', '.pdf', '.php', '.png', '.ppt', '.psd', '.rar', '.rtf', '.sql', '.ttf', '.txt', '.wav', '.wmv', '.xls', '.xlsx', '.zip']

function verifExt() {

}