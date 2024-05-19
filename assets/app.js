import './styles/app.css';

const odkazyNavigace = document.getElementById('odkazy');
const otevritMobilniNavigaci = document.getElementsByClassName('otevrit')[0];
const zavritMobilniNavigaci = document.getElementsByClassName('zavrit')[0];

otevritMobilniNavigaci.addEventListener('click', () => {
    odkazyNavigace.classList.add('otevreno');
    otevritMobilniNavigaci.classList.add('otevreno');
    zavritMobilniNavigaci.classList.add('otevreno');
});

zavritMobilniNavigaci.addEventListener('click', () => {
    odkazyNavigace.classList.remove('otevreno');
    otevritMobilniNavigaci.classList.remove('otevreno');
    zavritMobilniNavigaci.classList.remove('otevreno');
});

const otevriDialog = document.querySelectorAll("[data-otevri-dialog]");
const zavriDialog = document.querySelectorAll("[data-zavri-dialog]");
const dialogy = document.getElementsByTagName("dialog");
for (let i = 0; i < otevriDialog.length; i++){
    otevriDialog[i].addEventListener("click", (event) => {
            const dialogId = event.target.dataset.otevriDialog;
            document.getElementById(dialogId).showModal();
        }
    )
}
for (let i = 0; i < zavriDialog.length; i++){
    zavriDialog[i].addEventListener("click", (event) => {
            const dialogId = event.target.dataset.zavriDialog;
            document.getElementById(dialogId).close();
        }
    )
}
for (let i = 0; i < dialogy.length; i++){
    dialogy[i].addEventListener("click", (event) => {
            if(event.target === event.currentTarget){
                event.target.close();
            }
        }
    )
}

const zprava = document.getElementById("zprava");
let casZobrazeniZpravy = 200000;
if (zprava) {
    setTimeout(() => {
        zprava.remove();
    } , casZobrazeniZpravy);
}
