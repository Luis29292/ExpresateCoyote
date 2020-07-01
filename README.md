# Exprésate Coyote
## Equipo Flash
## Integrantes:
* Fernanda Villafán 
* Luis Domínguez
* Giovanni Garfias
* Natalia Pérez
* Montse Báez
## Guía de instalación
### Cosas Importantes previas a la instalación:
#### Aplicaciones: 
* Tener instalado [Xampp](https://www.mamp.info/en/downloads/) en el caso de Windows, o Linux.
* Tener instalado [Mamp](https://www.apachefriends.org/es/index.html) en el caso de macOS.
* Tener instalado [Git](https://git-scm.com/downloads) para el clonado del repositorio.
#### Especificaciones:
* Tener Activo el servidor de Apache, el cual podras activar desde la pestaña del **Panel de control** ubicado en: _*C:/(Tu_ruta_de_xampp)/*_, o por el contrario puedes acceder a el desde la barra de tareas en la seccion de busqueda (facilmente reconocible por su icono de una :mag:).
* También activar MySQL desde el panel de Control de Xampp.
* Clonar el repositorio dentro de C:/xampp/htdocs, para el correcto funcionamiento con localhost. 

## Guía de configuración
* En C:/xammp/mysql/bin, guardar el respaldo de la base de datos (BD_CoyoExpresate.sql).
* Tener activados apache y mysql.
* Crear un usuario llamado: "AdminCE" con la contraseña: "C0y03xpr354t3."(Importante el punto), en mysql.
* Darle todos los privilegios al usuario de mysql
* Crear una base llamada baseCE, e importar el respaldo (BD_CoyoExpresate.sql)
* Abrir index.html desde localhost, por ejemplo C:/xammp/htdocs/Proyecto-Final/index.html, se abriría como **localhost/Proyecto-Final/index.html** 
* Para iniciar sesión como alumno o como maestro, primero deberás registrarte y después ir a iniciar sesión.
* Para iniciar sesión como administrador, deberás ir a inicio de sesión, y darle en el botón **Eres administrador? Inicia Sesión AQUI**. Ahí podrás iniciar con el RFC "DOAL0107235M8" o con el correo "lolo3000024@me.com" y con la contraseña: "P0150nbl4bl4."
## Características 
* El administrador tiene la capacidad de eliminar usuarios.
* Todos los usuarios pueden crear encuestas
* Existen opciones para cambiar el correo y la contraseña, dentro de la configuración del perfil.
* Los alumnos y maestros pueden cambiar también su foto de perfil.
* Los usuarios pueden crear encuestas y verlas en la sección "Mis Encuestas"
* En la página principal de encuestas, hay un carrusel meramente informativo
* En la sección de créditos, se puede ver quiénes fueron los desarrolladores de este proyecto.
* El proyecto está diseñado para funcionar en computadoras, Moto G4 y el iPhone X.
## Comentarios adicionales 
Debido a problemas con la versión de PHP 7.4, ocurrieron errores a la hora de las consultas con JSON. Por lo que, el usuario puede crear encuestas, pero no contestar las creadas por otros. Durante el trabajo, surgieron algunos problemas, principalmente sobre la distribución de las tareas. Tuvimos conflictos, con la unión de las partes y con el manejo de github por parte de algunos miembros del equipo. Sin embargo, logramos una gran parte de nuestros objetivos, como el inicio y creación de encuestas, así como que el proyecto fuera adaptable y seguro. Consideramos, que incluye de manera equilibrada los temas vistos a lo largo del curso.
* Hubo un problema con la adaptabilidad de principalEncuestas.html debido a que se utiliza bootstrap para la barra de navegación y el carrusel de imágenes
