#!/usr/bin/env bash

composer install -n

rm -rf var/cache/*
rm -rf var/data/*
rm -rf var/logs/*
rm -rf var/sessions/*

HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/cache var/data var/logs var/sessions
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/cache var/data var/logs var/sessions

bin/console doctrine:database:create -n
bin/console doctrine:schema:create -n
