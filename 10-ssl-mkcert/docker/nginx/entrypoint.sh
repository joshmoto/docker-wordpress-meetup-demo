#!/bin/sh

# install our root certificates
mkcert -install

# begin generating our command
COMMAND="mkcert -cert-file /certs/dev.pem -key-file /certs/dev.key"

# generate our domain strings
for domain in $(echo "$SSL_DOMAINS" | sed "s/,/ /g")
do
  COMMAND="$COMMAND $domain"
done

# run our command to generate the certificates
echo "Running $COMMAND"
eval "$COMMAND"

# start nginx
echo "🔥 Firing up nginx..."
nginx -g "daemon off;"
