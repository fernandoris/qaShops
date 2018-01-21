FROM nginx:1.13

# Añadimos el archivo de configuración de ngnix
ADD /docker/nginx/default.conf /etc/nginx/conf.d/default.conf
ADD /docker/nginx/default.conf /etc/nginx/sites-available/default

CMD ["nginx", "-g", "daemon off;"]