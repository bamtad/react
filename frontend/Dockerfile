FROM node:alpine

WORKDIR /frontend
COPY package*.json ./
COPY entrypoint.sh entrypoint.sh
COPY . .
RUN npm install

ENTRYPOINT [ "npm","start","--","--watch" ]
