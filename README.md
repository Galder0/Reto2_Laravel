# ElorAdmin
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
[![License](https://img.shields.io/github/license/Ileriayo/markdown-badges?style=for-the-badge)](https://mit-license.org/)
## Descripción del Proyecto
ElorAdmin es una aplicación basada en Laravel diseñada para la Gestión Integral de Personal, incluyendo usuarios, departamentos, módulos y ciclos. También sirve como backend para la aplicación de mensajería ElorChat.

### Características Principales
- :busts_in_silhouette: Gestión de Usuarios: Registra y gestiona información de usuarios sin esfuerzo.
- :office: Gestión de Departamentos: Organiza al personal en departamentos para una administración eficiente.
- :package: Asignaciones de Módulos: Asigna usuarios a módulos específicos según roles o responsabilidades.
- :arrows_counterclockwise: Gestión de Ciclos: Realiza un seguimiento de ciclos para procesos organizativos estructurados.

## Tecnologías Utilizadas
La aplicación está construida utilizando las siguientes tecnologías:
- **PHP**: [8.2.11]
- **Laravel**: [10.31.0]
- **Bootstrap**: [5.3.2]

## Instalación
A continuación se describen los pasos para configurar la aplicación localmente:
### Prerrequisitos
Asegúrese de tener instalado lo siguiente:

- :whale: [Docker](https://www.docker.com/)
- :package: [Imagen de Docker](https://hub.docker.com/_/phpmyadmin)

### Pasos de Instalación

1. **Crear el contenedor Docker con la imagen correspondiente:**
   > Asegúrese de tener Docker instalado.
   
    Utilice el siguiente comando para crear el contenedor:
     ```bash
     docker run -d -p 3306:3306 --name phpmyadmin -e PMA_HOST=db phpmyadmin/phpmyadmin
     
2. **Clonar el repositorio:**
   ```git
   git clone https://github.com/Galder0/Reto2_Laravel.git
3. **Ejecutar las migraciones:**
    ```bash
    php artisan migrate
    
4. **Ejecutar las semillas:**
    ```bash
    php artisan db:seed
    
5. **Iniciar el servidor:**
    ```bash
    ./vendor/bin/sail up -d
    
La aplicación estará disponible en el localhost.

## Uso
- :computer: Accede a la aplicación a través de tu navegador web.
- :key: Inicia sesión y explora la interfaz fácil de usar para la gestión integral de personal.
- :arrows_counterclockwise: Utiliza los puntos finales de la API para la integración con ElorChat.

## Documentación
- ### API
La documentación detallada de la API se encuentra disponible en Swagger. Accede a Swagger Docs para explorar los puntos finales, modelos y autenticación de la API.
- ### Aplicación Web
La documentación completa de la aplicación, se encuentra en el siguiente <a href="link">documento</a>.

## Contacto
Para preguntas o problemas, puede ponerse en contacto con los mantenedores del proyecto:
- :computer: [Ager](mailto:ager.algortape@elorrieta-errekamari.com)
- :computer: [Galder](mailto:galder.gonzalez-balsiz@elorrieta-errekamari.com)
- :computer: [Ander](mailto:ander.lopezdevallejohi@elorrieta-errekamari.com)
## Licencia
Distribuido bajo la [MIT license](https://opensource.org/licenses/MIT).


