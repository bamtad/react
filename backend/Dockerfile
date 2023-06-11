FROM nginx:alpine

COPY nginx/conf.d /etc/nginx/conf.d
COPY nginx/fen.jpeg /medias/fen.jpeg
COPY nginx/adventure.jpeg /medias/adventure.jpeg
WORKDIR /etc/app

COPY . .
