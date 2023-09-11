FROM nginx:latest

# install mkcert dependencies
RUN apt-get update && apt-get install -y libnss3-tools

# install mkcert
WORKDIR /root/.local/share/mkcert
RUN curl -LJO "https://dl.filippo.io/mkcert/v1.4.3/mkcert-v1.4.3-linux-amd64" && \
    chmod +x mkcert-v1.4.3-linux-amd64 && \
    cp mkcert-v1.4.3-linux-amd64 /usr/local/bin/mkcert

RUN nginx -v