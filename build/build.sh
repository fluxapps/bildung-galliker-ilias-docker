#!/bin/bash
docker build . --pull --target  ilias -t bildung-galliker-ilias-docker/ilias:2023-02-12-1
docker build . --pull --target nginx -t bildung-galliker-ilias-docker/nginx:2023-02-12-1