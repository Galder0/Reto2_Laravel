document.addEventListener('DOMContentLoaded', function () {
  // Obtener el tema guardado o usar el tema preferido por el sistema
  const savedTheme = localStorage.getItem('theme');
  const systemPreferredTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  const currentTheme = savedTheme || systemPreferredTheme;

  // Establecer el tema inicial
  document.documentElement.setAttribute('data-bs-theme', currentTheme);

  // Función para alternar entre temas claro y oscuro
  function toggleTheme(newTheme) {
      // Actualizar el tema
      document.documentElement.setAttribute('data-bs-theme', newTheme);

      // Guardar la configuración del tema en localStorage
      localStorage.setItem('theme', newTheme);

      // Alternar la visibilidad del logo según el tema
      const lightLogo = document.getElementById('lightLogo');
      const darkLogo = document.getElementById('darkLogo');

      lightLogo.style.display = newTheme === 'light' ? 'inline' : 'none';
      darkLogo.style.display = newTheme === 'dark' ? 'inline' : 'none';
  }

  // Configuración inicial de visibilidad del logo
  toggleTheme(currentTheme);

  // Agregar un evento de clic a los botones de tema
  document.querySelectorAll('.dropdown-item').forEach((button) => {
      button.addEventListener('click', function () {
          const newTheme = this.getAttribute('data-bs-theme-value');
          toggleTheme(newTheme);

          // Actualizar el atributo 'aria-pressed'
          document.querySelectorAll('.dropdown-item').forEach((item) => {
              item.classList.remove('active');
          });
          this.classList.add('active');
      });
  });

  // Set the initial active state for the selected mode
  const initialActiveButton = document.querySelector(`[data-bs-theme-value="${currentTheme}"]`);
  initialActiveButton.classList.add('active');
});
