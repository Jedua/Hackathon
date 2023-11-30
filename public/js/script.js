// Código para el slider de imágenes
var sliderImages = document.querySelectorAll('.slider img');
var currentImage = 0;

function changeImage() {
    sliderImages[currentImage].style.display = 'none';
    currentImage = (currentImage + 1) % sliderImages.length;
    sliderImages[currentImage].style.display = 'block';
}

setInterval(changeImage, 3000);

// codigo para el nav
const menuToggle = document.getElementById("menu-toggle");
const menuText = document.getElementById("menu-text");

menuToggle.addEventListener("change", function() {
    if (menuToggle.checked) {
        menuText.textContent = "Cerrar Menu";
    } else {
        menuText.textContent = "Abrir Menu";
    }
});

document.querySelectorAll('input[name="tipo_usuario"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.tipo_usuario').forEach(function(div) {
            div.style.display = 'none';
        });
        document.getElementById('campos_' + this.value).style.display = 'block';
    });
});