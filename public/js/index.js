secciones = document.querySelectorAll('section');
links = document.querySelectorAll('nav div .links li a');
NavbarHeight = document.getElementById('navbar-principal').offsetHeight;

document.scrollingElement.style.scrollPaddingTop = NavbarHeight + 'px';

window.onscroll = () => {
    secciones.forEach(sec => {
        let top = window.scrollY;
        let height = sec.offsetHeight;
        let offset = sec.offsetTop - NavbarHeight;
        let id = sec.getAttribute('id');

        if (top >= offset && top < offset + height) {
            links.forEach(link => {
                link.classList.remove('active');
                document.querySelector('nav a[href*=' + id + ']').classList.add('active');
            });
        }
    });
}

links.forEach(link => {
    link.addEventListener('click', function(e){
        let direccion = link.href;
        let idDireccion = direccion.substring(direccion.indexOf('#')+1);
        let seccion = document.getElementById(idDireccion);
        
        seccion.scrollIntoView({behavior: 'smooth'}, true);
        e.preventDefault();
    })
});