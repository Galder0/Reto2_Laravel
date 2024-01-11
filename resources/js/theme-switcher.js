// Función para aplicar estilos específicos del tema al cuerpo de la página
document.addEventListener("DOMContentLoaded", function () {
    document.body.style.display = "block";
    document.body.classList.remove("preload");
});

function setTheme(themeValue) {
    document.documentElement.setAttribute('data-bs-theme', themeValue);
    localStorage.setItem('theme', themeValue);

    // Agregar o quitar la clase 'active' según el tema seleccionado
    document.querySelectorAll('.dropdown-item').forEach(button => {
        button.classList.remove('active');
    });
    document.querySelector(`[data-bs-theme-value="${themeValue}"]`).classList.add('active');
}

// Obtener el tema almacenado en localStorage o establecer 'light' como predeterminado  
var storedTheme = localStorage.getItem('theme') || 'light';
//hack: si no existe la clave o es texto "null", lo forzamos a modo "light"
if (storedTheme == null ||storedTheme == 'null'){
    storedTheme = 'light';
}

// Establecer el tema inicial y marcar como activo el botón correspondiente
document.documentElement.setAttribute('data-bs-theme', storedTheme);
document.querySelector(`[data-bs-theme-value="${storedTheme}"]`).classList.add('active');

// Manejar clic en los botones de tema
document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', (event) => {
        const themeValue = event.currentTarget.getAttribute('data-bs-theme-value');
        setTheme(themeValue);
    });
});
