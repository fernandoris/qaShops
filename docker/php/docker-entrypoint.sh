#!/bin/bash
set -e
echo >&2 "Open docker-entrypoint to $(pwd)"


cd downloadBorme
# Se crean las carpetas para los archivos temporales y los archivos txt
mkdir tmp
mkdir txt
# Si no exsite la carpeta de dependencias hacemos composer update
if ! [ -d vendor ]; then
  composer update
  echo >&2 "Añadido vendor a $(pwd)"
fi
cd ..

exec "$@"