// Esperamos que el DOM se haya cargado completamente
document.addEventListener('DOMContentLoaded', () => {

    // Obtenemos el ícono de hamburguesa y los enlaces del navbar
    const hamburger = document.querySelector('.hamburger');
    const navbarLinks = document.querySelector('.navbar-links');

    // Verificamos si los elementos existen
    if (!hamburger || !navbarLinks) {
        console.log("No se encontraron los elementos.");
        return;  // Si no se encuentran, no continúa el código
    }

    // Añadimos el evento de clic al botón de hamburguesa
    hamburger.addEventListener('click', () => {
        // Alternamos la clase 'active' en los enlaces del navbar
        navbarLinks.classList.toggle('active');
        
        // Opcional: Cambiar el ícono de hamburguesa a cruz al abrir
        hamburger.classList.toggle('active');  // Esto cambiará el estado visual del botón
    });
});
