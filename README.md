<p align="center"><a href="https://offhouse.vercel.app" target="_blank"><img src="https://user-images.githubusercontent.com/74844624/217299705-56ad3b15-b3cd-46c6-ab88-d3aa0d9f67be.png" width="100" alt="Laravel Logo"></a></p>

# OFFHOUSE - API REST

OffHouse es un ecommerce C2C (Comprador a Comprador) diseñado para la venta de electrodomésticos entre particulares. Con una interfaz intuitiva y fácil de usar, ofrece a los vendedores la capacidad de publicar sus productos y a los compradores la posibilidad de buscar y comprar productos en línea mediante un chat. Con seguridad en el pago y un sistema de comentarios para productos, OffHouse es una plataforma confiable para realizar transacciones en línea. ¡Únete a la comunidad de OffHouse y comienza a comprar y vender electrodomésticos de manera sencilla y segura!
## Requisitos

- PHP >= 7.2
- [Composer](https://getcomposer.org/)

## Instalación

1. Clona el repositorio en tu computadora.
2. Ejecuta `composer install` para instalar las dependencias del proyecto.
3. Crea un archivo `.env` a partir de `.env.example` y configura las variables de entorno, como la conexión a la base de datos.
4. Ejecuta `php artisan key:generate` para generar una clave para la aplicación.
5. Ejecuta `php artisan migrate` para ejecutar las migraciones y crear las tablas en la base de datos.

## Uso

La API REST de `OffHouse` te permite acceder y manipular los datos de la plataforma de manera programática. A continuación, se explica cómo funciona la API REST y cómo puedes utilizarla.

### Autenticación

Antes de poder hacer peticiones a la API REST, debes obtener un token de acceso válido. Puedes hacerlo a través de la autenticación con tu nombre de usuario y contraseña.

### Endpoints

La API REST de `OffHouse` expone diferentes endpoints para acceder y manipular los datos. Algunos ejemplos incluyen:

- `GET /products`: Obtiene una lista de todos los productos en el ecommerce.
- `GET /products/{id}`: Obtiene la información detallada sobre un producto en particular.
- `POST /products`: Publica un nuevo producto en el ecommerce.
- `POST /products/{id}`: Actualiza la información sobre un producto existente.
- `DELETE /products/{id}`: Elimina un producto del ecommerce.


### Peticiones

Puedes hacer peticiones a la API REST utilizando herramientas como [cURL](https://curl.haxx.se/) o [Postman](https://www.postman.com/). Por ejemplo, aquí hay una petición `GET` para obtener una lista de productos:


Reemplaza `{token}` con tu token de acceso válido y la respuesta será una lista de productos en formato JSON.

### Documentación

Para obtener más información sobre cómo funciona la API REST de `OffHouse` y cómo utilizarla, consulta la [documentación completa de la API](https://documenter.getpostman.com/view/22594154/2s935hSTPh).


## Contribución

¡Bienvenido al proyecto `OffHouse`! Estamos encantados de que te interese contribuir. Aquí hay algunas maneras en las que puedes ayudar:

- Reportar errores: Si encuentras un bug o tienes problemas para utilizar la plataforma, abre un informe de problema en GitHub. Asegúrate de incluir una descripción detallada y, si es posible, una forma de reproducir el problema.
- Proponer características: Si tienes una idea para mejorar la plataforma, abre un informe de solicitud de característica en GitHub. Asegúrate de incluir una descripción detallada de la característica y la motivación detrás de ella.
- Contribuir con código: Si quieres ayudar a desarrollar la plataforma, puedes hacerlo enviando pull requests en GitHub. Antes de comenzar, asegúrate de leer las directrices de contribución y tener en cuenta las buenas prácticas de programación.

Gracias por considerar contribuir a `OffHouse`. ¡Juntos podemos hacer que la plataforma sea aún mejor!

## Licencia

El código fuente de `OffHouse` está liberado bajo la licencia MIT. Puedes encontrar una copia de la licencia en el archivo [LICENSE](LICENSE).

## Créditos

- Desarrollo Frontend por [Dustin Chávez](https://github.com/Dustinouwu).
- Desarrollo Backend por [Miguel Muzo](https://github.com/Miguel-EMC).
