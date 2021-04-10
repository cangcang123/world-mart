# FROM harbor.infra.zalo.services/za/node:10.15.3
# WORKDIR /srv
# COPY .npmrc ./
# COPY package.json ./
# COPY package-lock.json ./
# RUN npm install
# COPY . .
# RUN npm run build && \
#         rm -f .npmrc
# EXPOSE 3000
# CMD pm2 start ecosystem.config.js --env production --no-daemon

FROM node:10.15.3-alpine
RUN apk add --no-cache --virtual .gyp \
        python \
        make \
        g++ \
        git && apk add busybox-extras
WORKDIR /srv
# COPY .npmrc ./
COPY package.json ./
COPY package-lock.json ./
# USER node
RUN npm install
# COPY . .
# COPY --chown=node:node . .
# RUN npm run serve

EXPOSE 3000

# CMD [ "node", "app.js" ]
# CMD pm2 start ecosystem.config.js --env production --no-daemon