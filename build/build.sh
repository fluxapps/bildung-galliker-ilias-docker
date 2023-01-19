#!/bin/bash
docker build . --target ilias -t bildung-galliker-ilias-docker/ilias:2023-01-19-1
docker build . --target nginx -t bildung-galliker-ilias-docker/nginx:2023-01-19-1