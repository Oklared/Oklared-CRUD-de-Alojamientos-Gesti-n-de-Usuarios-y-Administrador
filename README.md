Documentación del CRUD de Alojamientos: Gestión de Usuarios y Administrador en PHP y MYSQL

Descripción general

Este proyecto consiste en una aplicación web que permite la gestión de alojamientos a usuarios a través de operaciones CRUD en la Creación de usuarios y la Eliminación de estos utilizando como una base de datos MySQL con el servicio de XAMPP y como back-end de desarrollo con PHP para la gestión de usuarios y alojamientos, así también para manejar la autenticación e interacción con la base de datos.

Desarrollo

Los usuarios pueden registrarse mediante un formulario que recoge sus datos, como nombre, correo electrónico, contraseña y rol (usuario o administrativo), y una vez registrados, pueden iniciar sesión para acceder a su cuenta. Al ingresar, se les redirige a una página donde pueden seleccionar alojamientos disponibles que se encuentran precarga dos desde la base de datos, los administradores tienen permisos especiales, ya que pueden eliminar alojamientos de la base de datos, pero no pueden añadir los alojamientos de los usuarios. Además, los administradores tienen acceso para visualizar todos los usuarios registrados y eliminarlos si es necesario, lo que les otorga control total sobre la gestión de la aplicación. En la parte de la estructuración de los archivos, el proyecto se organiza en varias páginas PHP, como index.php para el registro de usuarios, registro.php para validar y almacenar los datos en la base de datos, validar_sesion.php para la autenticación de usuarios en el inicio de sesión, y cuenta_usuario.php, donde los administradores pueden ver y gestionar los alojamientos asociados a la cuenta de los usuarios. La base de datos, llamada mi_aplicacion, contiene las tablas usuarios (para almacenar los datos de los usuarios), alojamientos (para la información de los alojamientos) y usuario_alojamientos (para relacionar a los usuarios con los alojamientos seleccionados).El proyecto también implementa prácticas de seguridad como el uso de password_hash() y password_verify() para asegurar las contraseñas de los usuarios, y la autenticación se gestiona mediante sesiones PHP. La aplicación está pensada para ejecutarse en un servidor PHP con acceso a MySQL, proporcionando una interfaz sencilla y amigable que permite a los usuarios realizar las operaciones necesarias sin complicaciones. El repositorio en GitHub alberga todo el código fuente del proyecto, lo que permite su revisión, modificación y ampliación según sea necesario.









