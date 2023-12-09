document.addEventListener("DOMContentLoaded", function() {
    let noticias = document.querySelectorAll(".mov");
    let indice = 0;

    function mostrarSiguienteNoticia() {
        noticias[indice].style.opacity = 0;
        indice = (indice + 1) % noticias.length;
        noticias[indice].style.opacity = 1;
    }

  setInterval(mostrarSiguienteNoticia, 4500);
});