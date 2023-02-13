let listPro = document.querySelectorAll('.proList table tbody tr')
let infoPro = document.getElementsByClassName('proInfo')

function clickPro() {
    listPro.forEach((item) => {
        item.classList.remove('clicked');
    })
    this.classList.add('clicked');

}
listPro.forEach((item) => {
    item.addEventListener('click', clickPro);
    item.onclick = function () {
        const l = infoPro.classList;
        if (l.length == 1)
        {
            // infoPro[0].className += " show";
            // alert("0");
        }
            
        else {
            // infoPro[0].className.replace(" show", "");
            // alert("0");
        } 
    }
});