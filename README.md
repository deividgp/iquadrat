Symfony 5.4 Test
================

Preparación del test
--------------------

Mediante una serie de comandos utilizando la consola de Symfony (`php bin/console`), preparemos el test antes de empezar a programar.

**A continuación debes ejecutar los siguientes comandos en el terminal compartido de esta sesión:**

Crear la base de datos:

    $ php bin/console doctrine:database:create

El `schema` de la base de datos:

    $ php bin/console doctrine:schema:create

Debes generar los getters y los setters de las entidades:

    $ php bin/console make:entity --regenerate App

Y cargar las fixtures (datos iniciales):

    $ php bin/console doctrine:fixtures:load

Prueba nº 1
-----------

Debes implementar un listado de provincias en la ruta `/api/v1/provinces` del controlador `ApiController`, lo haremos mediante la entidad `Province` de `Doctrine`, el listado debe cumplir los siguientes requisitos:

*   Salida en formato `json`
*   Cada provincia debe tener los campos `id` y `name`
*   Ordenado por `name`
*   Debe pasar el test unitario `ProvinceTest`:
    
        $ php bin/phpunit tests\ProvinceTest.php
    
*   Debe pasar la validación `phpcs`:
    
        $ composer cs
    
*   Debe pasar la validación `phpstan`:
    
        $ composer stan
    

Prueba nº 2
-----------

Debes implementar el listado de las poblaciones de una provincia en la ruta `/api/v1/provinces/{id}/towns` del controlador `ApiController`, lo haremos mediante la entidad `Town` de `Doctrine`, el listado debe cumplir los siguientes requisitos:

*   Salida en formato `json`
*   Cada población debe tener los campos `id`, `name` y `cp`
*   Ordenado por `name`
*   Debe pasar el test unitario `TownTest`:
    
        $ php bin/phpunit tests\TownTest.php
    
*   Debe pasar la validación `phpcs`:
    
        $ composer cs
    
*   Debe pasar la validación `phpstan`:
    
        $ composer stan
    

Prueba nº 3
-----------

Debes implementar la recepción de un mensaje en la ruta `/api/v1/message` del controlador `ApiController` y almacenarlo en la base de datos, lo haremos mediante la entidad `Message` de `Doctrine`, una vez almacenado se debe responder con un objeto json con la clave `message` y el valor del mensaje recibido.

*   Método HTTP `PUT`
*   Dato de entrada `message`
*   Retorno de la petición `json`
    
        ['message' => 'This is a test message with unique id: 62cf59e7d93e5']
    
*   Debe pasar el test unitario `MessageTest`:
    
        $ php bin/phpunit tests\MessageTest.php
    
*   Debe pasar la validación `phpcs`:
    
        $ composer cs
    
*   Debe pasar la validación `phpstan`:
    
        $ composer stan
    

Prueba nº 4
-----------

Debes implementar el listado de los mensajes insertados en la prueba anterior ordenados por fecha de creación, lo haremos mediante la entidad `Message` de `Doctrine`.

*   Método HTTP `GET`
*   Formato `json`
*   Implementar el repositorio `MessageRepository`
*   Ruta `/api/v1/messages`

Prueba nº 5
-----------

Debes crear una nueva entidad `User` con los siguientes campos:

*   id
*   name
*   email
*   username
*   password
*   created\_at
*   updated\_at

Y generar los getters y setters

    $ php bin/console make:entity

Prueba nº 6
-----------

Debes crear un nuevo controlador `UserController` que implemente CRUD para la entidad `User`. ([https://en.wikipedia.org/wiki/Create,\_read,\_update\_and\_delete](https://en.wikipedia.org/wiki/Create,_read,_update_and_delete))

    $ php bin/console make:crud User

Prueba nº 7
-----------

Implementa un test unitario que verifique el correcto funcionamiento de las rutas del controlador `UserController`.