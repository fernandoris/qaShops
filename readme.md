# qaShops test

Prueba de acceso para qashops

## Getting Started

El primer ejercicio se encuentra en la carpeta volume/refactor.

El segundo ejercicio se encuentra en la carpeta volume/downloadBorme.

Ejecutar el siguiente comando para montar los contenedores.
```
docker-compose up -d
```
Hay que tener pacienciencia con la instalación de dependencias mediante composer. 
Se puede consultar el estado de la instalacion con 
```
docker-compose logs -f qashops_app
```
Se puede ejecutar el volume/downloadBorme/index.php accediendo a:

[http://0.0.0.0:9000/downloadBorme](http://0.0.0.0:9000/downloadBorme)

Tras ello debemos obtener en la carpeta volume/downloadBorme/txt el archivo 
```
volume/downloadBorme/txt/BORME-A-2017-6-41.txt
```
### Prerequisites

* [Docker](https://docs.docker.com/engine/installation/)

## Running the tests

Ejecutar los siguientes comandos

```
$ docker-compose exec qashops_app bash
# phpunit downloadBorme/test/BormeDownloaderTest.php

```
