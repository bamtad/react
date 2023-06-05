FROM node:alpine

WORKDIR /frontend
COPY package*.json ./
COPY . .

RUN npm install -g npm
RUN npm install

CMD ["npm", "start","--","--watch"]