FROM nginx:alpine

COPY nginx/conf.d /etc/nginx/conf.d
COPY nginx/offend.jpeg /medias/offend.jpeg
WORKDIR /etc/app

COPY . .
