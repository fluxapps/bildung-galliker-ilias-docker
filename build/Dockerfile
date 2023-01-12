# syntax=docker/dockerfile:1
FROM fluxfw/flux-ilias-ilias-base:php7.4 AS ilias
RUN /flux-ilias-ilias-base/bin/install-ilias-core.sh 7.17

# Plugin UserTakeOver
RUN /flux-ilias-ilias-base/bin/install-archive.sh https://github.com/srsolutionsag/UserTakeOver/archive/aefb7b18790e60e748bb4726ab116fe64b2a48cc.tar.gz /var/www/html/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/UserTakeOver

FROM fluxfw/flux-ilias-nginx-base:latest AS nginx
COPY --from=ilias /var/www/html /var/www/html