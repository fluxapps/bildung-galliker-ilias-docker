#!/bin/bash
docker build . --target ilias -t learn-medi-docker-ilias/ilias:2023-01-12-1
docker build . --target nginx -t learn-medi-docker-ilias/nginx:2023-01-12-1