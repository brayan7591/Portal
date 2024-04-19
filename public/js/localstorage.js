window.addEventListener('DOMContentLoaded', function () {
    let checkear = document.getElementById('flexSwitchCheckChecked');
    let fondo = document.getElementById('background-image');
    if (localStorage.getItem('theme')) {
        if (localStorage.getItem('theme') == 0) {
            fondo.hidden = false;
        }else{
            fondo.hidden = true;
            checkear.checked = true;
        }
    }else{
        localStorage.setItem('theme', 0);
    }
    checkear.addEventListener('click', function(){
        if (checkear.checked) {
            localStorage.setItem('theme', 1);
            fondo.hidden = true;
        }else{
            localStorage.setItem('theme', 0);
            fondo.hidden = false;
        }
    })
})

