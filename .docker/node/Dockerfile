FROM node:20

ARG uid=1000

RUN usermod -u $uid node

RUN npm config set registry http://registry.npmjs.org/
RUN npm config set cafile /usr/local/share/ca-certificates/zscaler.crt
RUN npm config set strict-ssl=false
RUN npm install -g npm@10.3.0
