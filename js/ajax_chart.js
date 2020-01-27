let selectYear;
let allWeeks;
let lastWeekId;

window.onload = (e) => {

    selectYear = document.querySelector("#select-week");
    allWeeks = selectYear.children;
    lastWeekId = allWeeks[allWeeks.length - 1].value;

    // Au chargement, affiche la semaine en cours
    fetchWeekInfo(lastWeekId);

}

// Quand je change mon select ...
document.querySelector("#select-week").addEventListener('change', (event) => {

    // Prend la valeur de l'option selectionné et fetch là.
    fetchWeekInfo(selectYear.options[selectYear.selectedIndex].value);
})


function fetchWeekInfo(week) {
    fetch(`/dashboard/week/${week}`)
        .then((res) => {
            return res.json()
        })
        .then((res) => {

            let wrapper = document.querySelector("#wrapper-chart");
            
            wrapper.innerHTML = res.canvas;

            let titleWeek = document.querySelector("#title-week");

            let dataUpload = res.dataUpload;
            let dataDownload = res.dataDownload;
            let dataExtUpload = res.dataExtUpload; 

            // console.log(dataExtUpload);
            titleWeek.innerHTML = `Semaine n°${dataExtUpload[0].week}`;

            let arrayUpload = arrayShowUploadFiles(dataUpload);
            let arrayDownload = arrayShowDownloadFiles(dataDownload);
            let arrayExt = createLabelForExtUpload(dataExtUpload); 
            let arrayDataExt = createArrayForDataExtUpload(dataExtUpload);
            // let arrayRandomColors = createArrayWithRandomColorForData(arrayDataExt);

            // Bar chart
            let uploadCharts = new Chart(document.getElementById("chartUpload"), {
                type: 'bar',
                data: {
                    labels: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
                    datasets: [{
                        label: "Upload by date",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#3cba9f", "#3e95cd"],
                        data: arrayUpload
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'UPLOAD/Jours'
                    }
                }
            });

            let downloadCharts = new Chart(document.getElementById("chartDownload"), {
                type: 'line',
                data: {
                    labels: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
                    datasets: [{
                        label: "Download by date",
                        // backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#3cba9f", "#3e95cd"],
                        fill: true,
                        borderColor: "#3cba9f",
                        data: arrayDownload
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'DOWNLOAD/Jours'
                    }
                }
            }); 

            // 
            new Chart(document.getElementById("chartExtUpload"), {
                type: 'pie',
                data: {
                  labels: arrayExt,
                  datasets: [{
                    label: "Extension des fichiers téléchargés",
                    // backgroundColor: arrayRandomColors,
                    backgroundColor: ["#C5E9FF", "#6F0CE8", "#FF0000", "#E8A13C", "#FFFD48", "#24E82D", "#FFC5F6", "#2D06FF", "#FF8A02"],
                    data: arrayDataExt
                  }]
                },
                options: {
                  title: {
                    display: true,
                    text: 'Extension des fichiers téléchargés'
                  }
                }
            });


        })
        .catch((err) => {
            if (err) throw err;
        })
}


function arrayShowUploadFiles(dataObject) {

    let array =  [0,0,0,0,0,0,0];

    for (let i of dataObject) {
        // console.log(i)

        switch (i.day) {
           case "Monday":
                array[0] = i.upload;
                break;
           case "Tuesday":
                array[1] = i.upload;
                break;
           case "Wednesday":
                array[2] = i.upload;                        
                break;
           case "Thursday":
                array[3] = i.upload;
                break;
           case "Friday":
                array[4] = i.upload;
                break;
           case "Saturday":
                array[5] = i.upload;                       
                break;
           case "Sunday":
                array[6] = i.upload;                       
                break;
            default:
                break;
        }
    }

    return array;
}

function arrayShowDownloadFiles(dataObject) {

    let array =  [0,0,0,0,0,0,0];

    for (let i of dataObject) {
        // console.log(i)

        switch (i.day) {
           case "Monday":
                array[0] = i.download;
                break;
           case "Tuesday":
                array[1] = i.download;
                break;
           case "Wednesday":
                array[2] = i.download;                        
                break;
           case "Thursday":
                array[3] = i.download;
                break;
           case "Friday":
                array[4] = i.download;
                break;
           case "Saturday":
                array[5] = i.download;                       
                break;
           case "Sunday":
                array[6] = i.download;                       
                break;
            default:
                break;
        }
    }

    return array;

}


function createLabelForExtUpload(object) {
    let array = [];

    for (let elem of object) {
        array.push(elem.ext);
    }

    return array;
}

function createArrayForDataExtUpload(object) {
    let array = [];

    for (let elem of object) {
        array.push(elem.count);
    }

    return array;
}

// function createArrayWithRandomColorForData(arrayData) {
    
//     let array = [];

//     for (let elem of arrayData) {
//         let randColor = `rgba(${rand(0,255)},${rand(0,255)},${rand(0,255)},0.5)`;
//         array.push(randColor);
//     }

//     return array;

// }

// function rand(min, max) {
//     return Math.random() * (max - min) + min;
//   }
