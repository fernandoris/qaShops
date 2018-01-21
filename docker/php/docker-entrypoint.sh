#!/bin/bash
set -e
echo >&2 "Open docker-entrypoint to $(pwd)"

# Si no exsite la carpeta de dependencias hacemos composer update
cd downloadBorme
if ! [ -d vendor ]; then
  composer update
  echo >&2 "Añadido vendor a $(pwd)"
fi
cd ..

exec "$@"