let myContentLink = document.querySelectorAll('.files_contenu')
const myDownloadIcon = document.querySelectorAll('.download_over')


for (let i = 0; i < myContentLink.length; i++) {
    myContentLink[i].addEventListener('mouseenter', downloadHoverX);
    myContentLink[i].addEventListener('mouseleave', downloadHoverY);

    function downloadHoverX() {
        myDownloadIcon[i].style.color = "#4AC6D4";
    }
    
    function downloadHoverY() {
        myDownloadIcon[i].style.color = "#13252D";
    
    }

}
