#!/bin/bash
BACKUP="/tmp/chefbook.env.local.bak"

cp .env "$BACKUP"
trap 'mv "$BACKUP" .env' EXIT

cp .env.wasmer .env
wasmer deploy