# CRUD-API-test
Ejemplo básico autenticación y CRUD con de api rest php y angular con una autenticación muy básica de usuario y contraseña.
Pasos para desplegar la Aplicación:

1-. Importar la BD en MySQL

2-. Publicar la carpeta Store en un servidor Web Apache

3-. Configurar las conexiones a la BD en los ficheros ApiProduct/ProductDB.php y ApiUser/UserDB.php

4-. Probar la conexión de las APIS rest desde el navegador mediante http://localhost/store/apistore/products que se muestre el json de los productos registrados. 

5-. Desde la consola acceder a la carpeta WebStore.

6-. Instalar las dependencias con npm install

7-. Levantar el servidor ejecutando ng serve

8-. Acceder al sistema usando cualquiera de estos dos niveles de usuario:
   admin@admin.com / admin123  Usuario que puede realizar todas las operaciones
   user@user.com / user123     Usuario con privilegio solamente de consulta
   
   
